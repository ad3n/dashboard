<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Entity\Chart;
use AppBundle\Util\QueryMapper;

class AddChartCommand extends ContainerAwareCommand
{
    const ENTITY_CLASS = 'AppBundle:Chart';

    protected function configure()
    {
        $this
            ->setName('app:chart:create')
            ->setDescription('Command to create chart')
            ->setDefinition(array(
                new InputArgument('name', InputArgument::REQUIRED, 'Nama chart'),
                new InputArgument('type', InputArgument::REQUIRED, 'Tipe chart'),
                new InputArgument('method', InputArgument::REQUIRED, 'Repository method'),
                new InputOption('description', null, InputOption::VALUE_OPTIONAL, 'Deskripsi chart'),
            ))
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $query = new QueryMapper(self::ENTITY_CLASS, $input->getArgument('method'));

        $chart = new Chart();
        $chart->setName($input->getArgument('name'));
        $chart->setType($input->getArgument('type'));
        $chart->setQuery(serialize($query));
        $chart->setDescription($input->getOption('description'));

        $entityManager = $this->getDoctrine();
        $entityManager->persist($chart);
        $entityManager->flush();

        $output->writeln(sprintf('<info>Chart <comment>%s</comment> berhasil dibuat.</info>', $chart->getName()));
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        if (! $input->getArgument('name')) {
            $name = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Masukkan nama chart:',
                function ($name) {
                    if (empty($name)) {

                        throw new \Exception('Nama chart tidak boleh kosong.');
                    }

                    return $name;
                }
            );

            $input->setArgument('name', $name);
        }

        if (! $input->getArgument('type')) {
            $type = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Masukkan tipe chart:',
                function ($type) {
                    if (empty($type)) {

                        throw new \Exception('Tipe chart tidak boleh kosong.');
                    }

                    return $type;
                }
            );

            $input->setArgument('type', $type);
        }

        if (! $input->getArgument('method')) {
            $repository = $this->getDoctrine()->getRepository(self::ENTITY_CLASS);

            $method = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Masukkan repository method:',
                function ($method) use ($repository) {
                    if (empty($method)) {

                        throw new \Exception('Repository method tidak boleh kosong.');
                    }

                    if (! method_exists($repository, $method)) {

                        throw new \Exception('Method harus valid dan callable.');
                    }

                    return $method;
                }
            );

            $input->setArgument('method', $method);
        }
    }

    protected function getDoctrine()
    {
        return $this->getContainer()->get('doctrine.orm.entity_manager');
    }
} 
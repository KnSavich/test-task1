<?php

namespace App\Command;

use App\Entity\Country;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InitDBCommand extends Command
{
    private EntityManagerInterface $entityManager;

    protected static $defaultName = 'init-db';

    public function __construct(EntityManagerInterface $entityManager, string $name = null)
    {
        $this->entityManager = $entityManager;
        parent::__construct($name);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $country = new Country('Германия', 'DE', 19);
        $this->entityManager->persist($country);

        $country = new Country('Италия', 'IT', 22);
        $this->entityManager->persist($country);

        $country = new Country('Греция', 'GR', 24);
        $this->entityManager->persist($country);

        $product = new Product('Наушники', 100);
        $this->entityManager->persist($product);

        $product = new Product('Чехол для телефона', 20);
        $this->entityManager->persist($product);

        $this->entityManager->flush();

        $output->writeln('Initial data has successfully imported to DB!');
        $output->writeln('And now you can use the application!');

        return Command::SUCCESS;
    }
}
<?php

namespace App\Form;

use App\Entity\Product;
use App\Validator\TaxNumber;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class PriceCalculatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'label' => 'Choose the product, that you wanna buy...',
                'error_bubbling' => true,
            ])
            ->add('taxNumber', TextType::class, [
                'label' => 'Your tax number:',
                'constraints' => [
                    new NotBlank([], 'The field "Tax number" can\'t be empty!'),
                    new TaxNumber(),
                ],
                'error_bubbling' => true,
            ])
            ->add('submit', SubmitType::class);
    }
}
<?php
// src/Form/Type/PostalAddressType.php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class PostalAddressType extends AbstractType
{
    
    public function BasketForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ProductName', TextType::class, [
                'help' => 'Product Name',
            ])
            ->add('price', IntegerType::class, [
                'help' => 'Apartment, suite, unit, building, floor',
            ])
            ->add('city', TextType::class)
            ->add('state', TextType::class, [
                'label' => 'State',
            ])
            ->add('zipCode', TextType::class, [
                'label' => 'ZIP Code',
            ])
        ;
    }
}
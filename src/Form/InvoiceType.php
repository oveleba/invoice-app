<?php
namespace App\Form;

use App\Entity\Invoice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('customer', TextType::class)
        ->add('supplier', TextType::class)
        ->add('issueDate', DateType::class, ['widget' => 'single_text'])
        ->add('dueDate', DateType::class, ['widget' => 'single_text'])
        ->add('taxDate', DateType::class, ['widget' => 'single_text'])
        ->add('paymentMethod', TextType::class)
        ->add('items', CollectionType::class, [
            'entry_type' => InvoiceItemType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
            'entry_options' => [
                'label' => false,
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Invoice::class,
        ]);
    }
}
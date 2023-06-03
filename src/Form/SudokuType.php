<?php

namespace App\Form;

use App\Service\SudokuValidationService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class SudokuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sudoku', FileType::class, [
                'label' => 'CSV file',
                'attr' => [
                    'class' => 'px-2',
                    'accept' => 'text/csv',
                ],
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => ['text/csv'],
                        'mimeTypesMessage' => 'Please, upload a valid CSV file',
                    ])
                ],
            ])
            ->add('check', SubmitType::class, [
                'label' => 'Check',
                'attr' => ['class' => 'btn btn-primary']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SudokuValidationService::class,
        ]);
    }
}

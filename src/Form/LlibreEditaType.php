<?php
namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Editorial;
class LlibreEditaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array
    $options)
    {
        $builder
        ->add('isbn', HiddenType::class)
        ->add('titol', TextType::class)
        ->add('autor', TextType::class)
        ->add('pagines', IntegerType::class)
        ->add('imatge', FileType::class, ['mapped' => false])
        ->add('editorial', EntityType::class,
                array('class' => Editorial::class,'choice_label' => 'nom',))
        ->add('save', SubmitType::class, array('label' => 'Enviar'));
    }
}
?>
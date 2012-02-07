<?php

namespace Ibrows\TaskBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('description');

        $builder->add('tags', 'collection', array(
            'type' => new TagType(),
            'allow_add' => true,
            'allow_delete' => true,
        ));
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Ibrows\TaskBundle\Entity\Task',
            'cascade_validation' => true,
        );
    }

    public function getName()
    {
        return 'task';
    }
}

?>

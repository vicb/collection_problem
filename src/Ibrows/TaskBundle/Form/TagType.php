<?php

namespace Ibrows\TaskBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TagType extends AbstractType {

    public function buildForm(FormBuilder $builder, array $options) {
        $builder->add('name');
    }

    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => 'Ibrows\TaskBundle\Entity\Tag',
        );
    }

    public function getName() {
        return 'tag';
    }

}

?>

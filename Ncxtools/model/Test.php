<?php
namespace Neuron\Application\Ncxtools;

use Neuron\Generic\Result;

class Test {

    public function getName() {

        return 'Ncxtools';
    }

    public function getTitle() {

        return 'NCX TOOLS';
    }

    public function getTagline() {

        return 'Ncx Management Tools';
    }

    public function getResult() {

        $result = new Result(time(), Result::CODE_SUCCESS, 'Test success!');
        $result->data = array(
            'name' => $this->getName(),
            'title' => $this->getTitle(),
            'tagline' => $this->getTagline(),
        );
        return $result;
    }
}
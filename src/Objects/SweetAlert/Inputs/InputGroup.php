<?php

namespace LiveControls\Alerts\Objects\SweetAlert\Inputs;

use Exception;

class InputGroup
{
    public readonly string $groupId;
    public readonly string $groupClass;
    public array $inputs;

    public function __construct(string $groupId, string $class = "")
    {
        $this->groupId = $groupId;
        $this->groupClass = $class;
        $this->inputs = [];
    }

    public function add(TextInput|NumericInput|ColorInput|DateInput|TimeInput|TextArea|SelectInput|RadioInput|FileInput ...$inputs){
        foreach($inputs as $input){
            if(array_key_exists($input->getName(), $this->inputs)){
                throw new Exception('Input with the name "'.$input->getName().'" already exists in InputGroup!');
            }
            $this->inputs[$input->getName()] = $input;
        }
    }

    public function remove(string $name){
        $newInputs = [];
        foreach($this->inputs as $input){
            if($input->getName() != $name){
                $newInputs[$input->getName()] = $input;
            }
        }
        $this->inputs = $newInputs;
    }

    public function __toString():string{
        $html = '<div id="'.$this->groupId.'" class="'.$this->groupClass.'">';
        foreach($this->inputs as $input){
            $html .= $input->toArray()["html"];
        }
        $html .= '</div>';

        return $html;
    }

    public function toArray():array{
        $arr = [];
        foreach($this->inputs as $input){
            array_push($arr,$input->toArray());
        }
        return $arr;
    }
}
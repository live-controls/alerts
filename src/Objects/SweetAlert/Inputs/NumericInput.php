<?php

namespace LiveControls\Alerts\Objects\SweetAlert\Inputs;

class NumericInput extends Input {
    public string $inputType = 'number';

    public ?string $minValue = null;
    public ?string $maxValue = null;
    public ?float $step = null;

    public function __construct($inputName, $value = "", string $label = "", string $placeHolder = "", ?int $min = null, ?int $max = null, ?float $step = null)
    {
        $this->minValue = $min;
        $this->maxValue = $max;
        $this->step = $step;
        parent::__construct($inputName, $value, $label, $placeHolder);
    }

    public function toArray():array{
        $html = '<div class="'.$this->parentClass.'">';
        if($this->label != null && $this->label != ''){
            $html.= '<label for="'.$this->inputName.'" class="form-label">'.$this->label.'</label>';
        }
        $html .= '<input type="'.$this->inputType.'" class="'.$this->class.'" name="'.$this->inputName.'" id="'.$this->inputName.'" value="'.$this->value.'" placeholder="'.$this->placeHolder.'"';
        if(!is_null($this->minValue)){
            $html .= ' min="'.$this->minValue.'"';
        }
        if(!is_null($this->maxValue)){
            $html .= ' max="'.$this->maxValue.'"';
        }
        if(!is_null($this->step)){
            $html .= ' step="'.str_replace(',','.', $this->step).'"';
        }
        $html .= ($this->disabled ? ' disabled' : '').($this->required ? ' required' : '').'>'; //Close the input tag
        $html .= '</div>';
        return [
            'name' => $this->inputName,
            'html' => $html
        ];
    }
}
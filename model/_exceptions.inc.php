<?php
class FFSUnregisteredDataException extends Exception{
    public function __construct($strKey, $strVal){
        parent::__construct(
            sprintf(
                'You do not have a "%s" created named "%s"',
                $strKey,
                $strVal
            )
        );
    }
}
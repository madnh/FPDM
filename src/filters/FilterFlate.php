<?php
namespace FPDM\Filters;

class FilterFlate
{

    public $data = null;
    public $dataLength = 0;


    /**
     * Method to decode GZIP compressed data.
     * @param string $data The compressed data.
     * @return string
     * @throws \Exception
     */
    public function decode($data)
    {

        $this->data = $data;
        $this->dataLength = strlen($data);

        // uncompress
        $data = gzuncompress($data);

        if (!$data) {
            throw new \Exception("FilterFlateDecode: invalid stream data.");
        }
        return $data;
    }


    function encode($in)
    {
        return gzcompress($in, 9);
    }
}

?>
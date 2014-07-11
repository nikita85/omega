<?php

class CsvExport extends CComponent
{
    private $getItemLimit = 5000;

    public function init() {}

    public function send($model, $columns, $reportPrefix)
    {

        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=" . $reportPrefix . "_" . date('Y-m-d') . '.csv');
        header("Content-Type: application/octet-stream");
        header("Content-Transfer-Encoding: binary");

        echo "\xEF\xBB\xBF";

        $row = array();

        foreach ($columns as $col => $val) {

           // $row[] = $model->getAttributeLabel((is_string($val) ? $val : $col));
            $row[] = $col;
        }

        echo implode(';', $row) . PHP_EOL;

        $dataProvider = $model->search();

        $count = (int) $dataProvider->getTotalItemCount() + $this->getItemLimit;

        $current_page = 0;

        function omg($item, $keyArray)  {
            $result = null;
            $tmp = $item;
            foreach ($keyArray as $i => $part) {
                $tmp = $tmp->$part;

                if(is_array($tmp)) {
                    $partLeft = array_slice($keyArray, $i + 1);
                    $result = '"';
                    foreach($tmp as $tmpItem) {
                        $result .= omg($tmpItem, $partLeft);
                        if($tmpItem !== end($tmp)){
                            $result .= PHP_EOL;
                        }
                    }
                    $result .= '"';
                    break;

                } else {
                    $result = $tmp;
                }
            }
            return $result;
        };

        while ($count > $this->getItemLimit) {

            $dataProvider->setPagination([
                'pageSize' => $this->getItemLimit,
                'currentPage' => $current_page + 1
            ]);

            foreach ($dataProvider->getData(true) as $item) {

                $row = [];

                foreach ($columns as $val) {

/*                    if (strpos($val, '.') !== false) {
                        $parts = explode('.', $val);

                        $tmp = $item;
                        foreach ($parts as $part) {
                            $tmp = $tmp->$part;
                        }
                        $row[] = $tmp;
                    } else {
                        $row[] = $item->{$val};
                    }*/

                    if (strpos($val, '.') !== false) {
                        $parts = explode('.', $val);

                        $row[] = omg($item, $parts);

                    } else {
                        $row[] = $item->{$val};
                    }

                }

                echo implode(';', $row) . PHP_EOL;
            }
            $count -= $this->getItemLimit;
            $current_page++;
        }


    }
}

<?php
$sql="CREATE TABLE `data_collected` (
`id` int(11) NOT NULL DEFAULT '0',
`sensor_number` int(11) NOT NULL DEFAULT '0',
`data_date` date NOT NULL DEFAULT '0000-00-00',
`data_time` char(4) NOT NULL DEFAULT '',
`value` varchar(255) NOT NULL,
PRIMARY KEY (`id`,`sensor_number`,`data_date`,`data_time`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1
/*!50100 PARTITION BY RANGE (YEAR(data_date))
SUBPARTITION BY HASH (MONTH(data_date))
(";

for($i=2012;$i<2016;$i++)
{
$m=$i-1;
$sql.="\nPARTITION p$m VALUES LESS THAN ($i)
(SUBPARTITION s_dec_$m ENGINE = MyISAM,
SUBPARTITION s_jan_$m ENGINE = MyISAM,
SUBPARTITION s_feb_$m ENGINE = MyISAM,
SUBPARTITION s_mar_$m ENGINE = MyISAM,
SUBPARTITION s_apr_$m ENGINE = MyISAM,
SUBPARTITION s_may_$m ENGINE = MyISAM,
SUBPARTITION s_jun_$m ENGINE = MyISAM,
SUBPARTITION s_jul_$m ENGINE = MyISAM,
SUBPARTITION s_aug_$m ENGINE = MyISAM,
SUBPARTITION s_sep_$m ENGINE = MyISAM,
SUBPARTITION s_oct_$m ENGINE = MyISAM,
SUBPARTITION s_nov_$m ENGINE = MyISAM)";
if ($i!=2011)
$sql.=',';
else
$sql.=")*/";
}

print_r($sql);

?>
<?php
if($season == 'merged') {
    $view = 'CREATE OR REPLACE VIEW ' . strtoupper($region) . '_' . $account['id'] . '_MERGED AS';
    $firstview = true;

    if ($s6g) {
        if ($s6dynamic) {
            if ($firstview) {
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2016_DYNAMIC';
                $firstview = false;
            } else {
                $view .= ' UNION ALL';
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2016_DYNAMIC';
            }
            $querygametable = createGamesTableIfNotExists(strtoupper($region) . '_' . $account['id'] . '_SEASON2016_DYNAMIC');
            $resultgametable = $conn->prepare($querygametable);
            $resultgametable->execute();
        }
        if ($s6solo) {
            if ($firstview) {
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2016_SOLO';
                $firstview = false;
            } else {
                $view .= ' UNION ALL';
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2016_SOLO';
            }
            $querygametable = createGamesTableIfNotExists(strtoupper($region) . '_' . $account['id'] . '_SEASON2016_SOLO');
            $resultgametable = $conn->prepare($querygametable);
            $resultgametable->execute();
        }
        if ($s6team5) {
            if ($firstview) {
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2016_TEAM5';
                $firstview = false;
            } else {
                $view .= ' UNION ALL';
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2016_TEAM5';
            }
            $querygametable = createGamesTableIfNotExists(strtoupper($region) . '_' . $account['id'] . '_SEASON2016_TEAM5');
            $resultgametable = $conn->prepare($querygametable);
            $resultgametable->execute();
        }
        if ($s6team3) {
            if ($firstview) {
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2016_TEAM3';
                $firstview = false;
            } else {
                $view .= ' UNION ALL';
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2016_TEAM3';
            }
            $querygametable = createGamesTableIfNotExists(strtoupper($region) . '_' . $account['id'] . '_SEASON2016_TEAM3');
            $resultgametable = $conn->prepare($querygametable);
            $resultgametable->execute();
        }
    }
    if ($s5g) {
        if ($s5dynamic) {
            if ($firstview) {
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2015_DYNAMIC';
                $firstview = false;
            } else {
                $view .= ' UNION ALL';
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2015_DYNAMIC';
            }
            $querygametable = createGamesTableIfNotExists(strtoupper($region) . '_' . $account['id'] . '_SEASON2015_DYNAMIC');
            $resultgametable = $conn->prepare($querygametable);
            $resultgametable->execute();
        }
        if ($s5solo) {
            if ($firstview) {
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2015_SOLO';
                $firstview = false;
            } else {
                $view .= ' UNION ALL';
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2015_SOLO';
            }
            $querygametable = createGamesTableIfNotExists(strtoupper($region) . '_' . $account['id'] . '_SEASON2015_SOLO');
            $resultgametable = $conn->prepare($querygametable);
            $resultgametable->execute();
        }
        if ($s5team5) {
            if ($firstview) {
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2015_TEAM5';
                $firstview = false;
            } else {
                $view .= ' UNION ALL';
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2015_TEAM5';
            }
            $querygametable = createGamesTableIfNotExists(strtoupper($region) . '_' . $account['id'] . '_SEASON2015_TEAM5');
            $resultgametable = $conn->prepare($querygametable);
            $resultgametable->execute();
        }
        if ($s5team3) {
            if ($firstview) {
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2015_TEAM3';
                $firstview = false;
            } else {
                $view .= ' UNION ALL';
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2015_TEAM3';
            }
            $querygametable = createGamesTableIfNotExists(strtoupper($region) . '_' . $account['id'] . '_SEASON2015_TEAM3');
            $resultgametable = $conn->prepare($querygametable);
            $resultgametable->execute();
        }
    }
    if ($s4g) {
        if ($s4dynamic) {
            if ($firstview) {
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2014_DYNAMIC';
                $firstview = false;
            } else {
                $view .= ' UNION ALL';
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2014_DYNAMIC';
            }
            $querygametable = createGamesTableIfNotExists(strtoupper($region) . '_' . $account['id'] . '_SEASON2014_DYNAMIC');
            $resultgametable = $conn->prepare($querygametable);
            $resultgametable->execute();
        }
        if ($s4solo) {
            if ($firstview) {
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2014_SOLO';
                $firstview = false;
            } else {
                $view .= ' UNION ALL';
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2014_SOLO';
            }
            $querygametable = createGamesTableIfNotExists(strtoupper($region) . '_' . $account['id'] . '_SEASON2014_SOLO');
            $resultgametable = $conn->prepare($querygametable);
            $resultgametable->execute();
        }
        if ($s4team5) {
            if ($firstview) {
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2014_TEAM5';
                $firstview = false;
            } else {
                $view .= ' UNION ALL';
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2014_TEAM5';
            }
            $querygametable = createGamesTableIfNotExists(strtoupper($region) . '_' . $account['id'] . '_SEASON2014_TEAM5');
            $resultgametable = $conn->prepare($querygametable);
            $resultgametable->execute();
        }
        if ($s4team3) {
            if ($firstview) {
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2014_TEAM3';
                $firstview = false;
            } else {
                $view .= ' UNION ALL';
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2014_TEAM3';
            }
            $querygametable = createGamesTableIfNotExists(strtoupper($region) . '_' . $account['id'] . '_SEASON2014_TEAM3');
            $resultgametable = $conn->prepare($querygametable);
            $resultgametable->execute();
        }
    }
    if ($s3g) {
        if ($s3dynamic) {
            if ($firstview) {
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2013_DYNAMIC';
                $firstview = false;
            } else {
                $view .= ' UNION ALL';
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2013_DYNAMIC';
            }
            $querygametable = createGamesTableIfNotExists(strtoupper($region) . '_' . $account['id'] . '_SEASON2013_DYNAMIC');
            $resultgametable = $conn->prepare($querygametable);
            $resultgametable->execute();
        }
        if ($s3solo) {
            if ($firstview) {
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2013_SOLO';
                $firstview = false;
            } else {
                $view .= ' UNION ALL';
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2013_SOLO';
            }
            $querygametable = createGamesTableIfNotExists(strtoupper($region) . '_' . $account['id'] . '_SEASON2013_SOLO');
            $resultgametable = $conn->prepare($querygametable);
            $resultgametable->execute();
        }
        if ($s3team5) {
            if ($firstview) {
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2013_TEAM5';
                $firstview = false;
            } else {
                $view .= ' UNION ALL';
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2013_TEAM5';
            }
            $querygametable = createGamesTableIfNotExists(strtoupper($region) . '_' . $account['id'] . '_SEASON2013_TEAM5');
            $resultgametable = $conn->prepare($querygametable);
            $resultgametable->execute();
        }
        if ($s3team3) {
            if ($firstview) {
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2013_TEAM3';
                $firstview = false;
            } else {
                $view .= ' UNION ALL';
                $view .= ' SELECT * FROM ' . strtoupper($region) . '_' . $account['id'] . '_SEASON2013_TEAM3';
            }
            $querygametable = createGamesTableIfNotExists(strtoupper($region) . '_' . $account['id'] . '_SEASON2013_TEAM3');
            $resultgametable = $conn->prepare($querygametable);
            $resultgametable->execute();
        }
    }

    $resultview = $conn->prepare($view);
    $resultview->execute();
}
?>
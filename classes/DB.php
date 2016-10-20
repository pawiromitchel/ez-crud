<?php
      class DB {
            public static function connect($host, $dbname, $username, $password){
                  return new mysqli($host, $username, $password, $dbname);
            }

            public static function query($sql, $connection){
                $run = $connection->query($sql);

                if ($run !== false) {
                    $resultArray = array();
                    while ($result = $run->fetch_assoc()) {
                          $resultArray[] = $result;
                    }
                    // returns the results
                    return $resultArray;
                    // close connection
                    mysqli_close($this->connection);
                } else {
                    return 0;
                }
            }

            public static function delete($sql, $connection){
                $run = $connection->query($sql);
                  
                if ($run !== false) {
                    return 1;
                    // close connection
                    mysqli_close($this->connection);
                } else {
                    return 0;
                }
            }

            public static function insert($sql, $connection){
                $run = $connection->query($sql);
                  
                if ($run !== false) {
                    return $connection->insert_id;
                    // close connection
                    mysqli_close($this->connection);
                } else {
                    return 0;
                }
            }
      }
?>
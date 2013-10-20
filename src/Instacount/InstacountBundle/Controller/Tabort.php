<?php
$query = $em->createQuery(
                'SELECT c
                FROM InstacountInstacountBundle:Counter c
                WHERE c.campaign = :campaign
                AND c.timestamp > :timestamp')
                ->setParameters(array(
                    'campaign' => $campaign_id,
                    'timestamp'  => DATE_FORMAT(timestamp, 'Date(%Y,%m%d)')
                )); 
$result = $query->getResult();
$rows = array();
$table = array();
$table['cols'] = array(
  array('label' => 'timestamp', 'type' => 'date'),
  array('label' => 'count', 'type' => 'number')
);
foreach($result as $r) {
  $temp = array();
  $temp[] = array('v' => $r['timestamp']); 
  $temp[] = array('v' => (int) $r['count']); 
  $rows[] = array('c' => $temp);
}
$table['rows'] = $rows;
$jsonTable = json_encode($table);
echo $jsonTable;
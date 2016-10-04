<?php

return function($site, $pages, $page) {

  $query   = get('q');
  $results = $site->search($query, 'title|text|tags|city|publisher|author|category');

  return array(
    'query'   => $query,
    'results' => $results,
    'pagination' => $results->pagination()
  );

};
?>
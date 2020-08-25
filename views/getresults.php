<?php

/**
 * Library Requirements
 *
 * 1. Install composer (https://getcomposer.org)
 * 2. On the command line, change to this directory (api-samples/php)
 * 3. Require the google/apiclient library
 *    $ composer require google/apiclient:~2.0
 */
if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
  throw new \Exception('please run "composer require google/apiclient:~2.0" in "' . __DIR__ .'"');
}

require_once __DIR__ . '/vendor/autoload.php';

if (isset($_POST['search'])) {
	/*
   * Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
   * {{ Google Cloud Console }} <{{ https://cloud.google.com/console }}>
   * Please ensure that you have enabled the YouTube Data API for your project.
   */
  $DEVELOPER_KEY = 'AIzaSyBUEKfL6HpVobAU8WW7MVFjimJesPZVnG8';

  $client = new Google_Client();
  $client->setDeveloperKey($DEVELOPER_KEY);

  // Define an object that will be used to make all API requests.
  $youtube = new Google_Service_YouTube($client);
  try {

    // Call the search.list method to retrieve results matching the specified
    // query term.
    $searchResponse = $youtube->search->listSearch('id,snippet', array(
      'q' => $_POST['search'],
      'maxResults' => 2,
    ));
    //echo "<table>d"
    $i = 0;
foreach ($searchResponse['items'] as $searchResult) {
	switch ($searchResult['id']['kind']) {
		case 'youtube#video':
                echo '<div id="vid'.$i.'" style="display:inline-block; vertical-align: middle"><iframe src="https://www.youtube.com/embed/'.$searchResult['id']['videoId'].'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> <button id="playbutton" style="margin-bottom=30px;">Play</button>
</div><br>';
		break;
}
}
} catch (Google_Service_Exception $e) {
   echo '<p>A service error occurred: <code>'.$e->getMessage().'</code></p>';
  } catch (Google_Exception $e) {
    echo '<p>An client error occurred: <code>%s</code></p>';
  }
}
?>


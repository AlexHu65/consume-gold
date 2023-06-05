<?php

namespace App\Helpers;

use App\Models\Configuraciones;
use Google_Client;
use Google_Exception;
use Google_Http_MediaFileUpload;
use Google_Service_Exception;
use Google_Service_YouTube;
use Google_Service_YouTube_Video;
use Google_Service_YouTube_VideoSnippet;
use Google_Service_YouTube_VideoStatus;
use Illuminate\Http\UploadedFile;

class YoutubeUploader
{

  /**
   * @param UploadedFile $tempVideo
   * @param YoutubeMeta $meta
   *
   * @return int|null
   */
  public function __invoke($tempVideo, $meta)
  {
    $configuracion = Configuraciones::where('nombre', 'youtubeAuth')->first();
    $auth = json_decode($configuracion->valor, true);
    $OAUTH2_CLIENT_ID = '1067799599968-thusb9oaa63ejpdn0jemb3bp4me8tr6f.apps.googleusercontent.com';
    $OAUTH2_CLIENT_SECRET = '-pDAZeEfjxK89zPh0WyHfp55';
    $accessToken = $auth;
    $refreshToken = $auth['refresh_token'];

    $client = new Google_Client();
    $client->setClientId($OAUTH2_CLIENT_ID);
    $client->setClientSecret($OAUTH2_CLIENT_SECRET);
    $client->setScopes('https://www.googleapis.com/auth/youtube.upload');
    $client->setRedirectUri('http://localhost/test');
    $client->setAccessType('offline');
    $client->setApprovalPrompt('force');
    $client->setAccessToken($accessToken);

    // Define an object that will be used to make all API requests.
    $youtube = new Google_Service_YouTube($client);

    if ($client->isAccessTokenExpired()) {
      $accessToken = $client->fetchAccessTokenWithRefreshToken($refreshToken);
      $client->setAccessToken($accessToken);
    }

    // Check to ensure that the access token was successfully acquired.
    if ($client->getAccessToken()) {
      try {
        // REPLACE this value with the path to the file you are uploading.
        $videoPath = $tempVideo->getRealPath();


        // Create a snippet with title, description, tags and category ID
        // Create an asset resource and set its snippet metadata and type.
        // This example sets the video's title, description, keyword tags, and
        // video category.
        $snippet = new Google_Service_YouTube_VideoSnippet();
        $snippet->setTitle($meta->getTitle());
        $snippet->setDescription($meta->getDescription());
        $snippet->setTags($meta->getTags());

        // Numeric video category. See
        // https://developers.google.com/youtube/v3/docs/videoCategories/list
        $snippet->setCategoryId("22");

        // Set the video's status to "public". Valid statuses are "public",
        // "private" and "unlisted".
        $status = new Google_Service_YouTube_VideoStatus();
        $status->privacyStatus = "unlisted";

        // Associate the snippet and status objects with a new video resource.
        $video = new Google_Service_YouTube_Video();
        $video->setSnippet($snippet);
        $video->setStatus($status);

        // Specify the size of each chunk of data, in bytes. Set a higher value for
        // reliable connection as fewer chunks lead to faster uploads. Set a lower
        // value for better recovery on less reliable connections.
        $chunkSizeBytes = 1 * 1024 * 1024;

        // Setting the defer flag to true tells the client to return a request which can be called
        // with ->execute(); instead of making the API call immediately.
        $client->setDefer(true);

        // Create a request for the API's videos.insert method to create and upload the video.
        $insertRequest = $youtube->videos->insert("status,snippet", $video);

        // Create a MediaFileUpload object for resumable uploads.
        $media = new Google_Http_MediaFileUpload(
          $client,
          $insertRequest,
          'video/*',
          null,
          true,
          $chunkSizeBytes
        );
        $media->setFileSize($tempVideo->getSize());

        // Read the media file and upload it chunk by chunk.
        $status = false;
        $handle = fopen($videoPath, "rb");
        while (!$status && !feof($handle)) {
          $chunk = fread($handle, $chunkSizeBytes);
          $status = $media->nextChunk($chunk);
        }

        fclose($handle);

        // If you want to make other calls after the file upload, set setDefer back to false
        $client->setDefer(false);

        return $status['id'];
      } catch (Google_Service_Exception $e) {
        $error = sprintf('<p>A service error occurred: <code>%s</code></p>',
          htmlspecialchars($e->getMessage()));

        return '';
      } catch (Google_Exception $e) {
        $error = sprintf('<p>An client error occurred: <code>%s</code></p>',
          htmlspecialchars($e->getMessage()));

        return '';
      }

    } else {
      $authUrl = $client->createAuthUrl();

      return '';
    }
  }
}

<?php

namespace App\Helpers;

class YoutubeMeta
{
  /**
   * @var string
   */
  private $title;

  /**
   * @var string
   */
  private $description;

  /**
   * @var string[]
   */
  private $tags;

  /**
   * @param string $title
   * @param string $description
   * @param string[] $tags
   *
   */
  public function __construct(string $title, string $description, array $tags)
  {
    $this->title = $title;
    $this->description = $description;
    $this->tags = $tags;
  }


  /**
   * @return string
   */
  public function getTitle(): string
  {
    return $this->title;
  }

  /**
   * @param string $title
   *
   * @return YoutubeMeta
   */
  public function setTitle(string $title): YoutubeMeta
  {
    $this->title = $title;
    return $this;
  }

  /**
   * @return string
   */
  public function getDescription(): string
  {
    return $this->description;
  }

  /**
   * @param string $description
   *
   * @return YoutubeMeta
   */
  public function setDescription(string $description): YoutubeMeta
  {
    $this->description = $description;
    return $this;
  }

  /**
   * @return string[]
   */
  public function getTags(): array
  {
    return $this->tags;
  }

  /**
   * @param string[] $tags
   *
   * @return YoutubeMeta
   */
  public function setTags(array $tags): YoutubeMeta
  {
    $this->tags = $tags;
    return $this;
  }


}

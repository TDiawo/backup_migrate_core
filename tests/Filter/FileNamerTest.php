<?php
/**
 * @file
 */

namespace BackupMigrate\Core\Tests\Filter;

use BackupMigrate\Core\Filter\FileNamer;
use BackupMigrate\Core\Tests\TempFileConsumerTestTrait;
use PHPUnit_Framework_TestCase;


/**
 * Class FileNamerTest
 * @package BackupMigrate\Core\Tests\Filter
 */
class FileNamerTest extends PHPUnit_Framework_TestCase {
  use TempFileConsumerTestTrait;

  function setUp() {
    $this->_setUpFiles();
  }

  /**
   * covers ::afterBackup;
   */
  function testNaming() {
    $file = $this->manager->create('txt');

    $filter = new FileNamer(
      ['filename' => 'testfile']
    );
    $file = $filter->afterBackup($file);
    $this->assertEquals('testfile.txt', $file->getFullName());
  }

  /**
   * covers ::afterBackup;
   */
  function testTimestamp() {
    $file = $this->manager->create('txt');

    $filter = new FileNamer(
      ['filename' => 'testfile', 'timestamp' => TRUE, 'timestamp_format' => 'Y-m-d']
    );
    $file = $filter->afterBackup($file);
    $date = gmdate('Y-m-d');
    $this->assertEquals("testfile-$date.txt", $file->getFullName());
  }
}

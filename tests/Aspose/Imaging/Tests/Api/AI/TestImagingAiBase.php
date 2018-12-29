<?php
/**
 * --------------------------------------------------------------------------------------------------------------------
 * <copyright company="Aspose" file="TestImagingAiBase.php">
 *   Copyright (c) 2019 Aspose Pty Ltd. All rights reserved.
 * </copyright>
 * <summary>
 *   Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is
 *  furnished to do so, subject to the following conditions:
 * 
 *  The above copyright notice and this permission notice shall be included in all
 *  copies or substantial portions of the Software.
 * 
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 *  SOFTWARE.
 * </summary>
 * --------------------------------------------------------------------------------------------------------------------
 */

namespace Aspose\Imaging\Tests\Api\AI;

use \Aspose\Imaging\Tests\Base\ApiTester;
use \Aspose\Imaging\Model as ImagingModel;
use \Aspose\Imaging\Model\Requests as ImagingRequests;
use \Aspose\Storage\Api\StorageApi;
use \Aspose\Storage\Model as StorageModel;
use \Aspose\Storage\Model\Requests as StorageRequests;
use \DateTime;
use \Exception;

/**
 * Base class for testing AI
 */
abstract class TestImagingAiBase extends ApiTester
{
    /**
     * The cloud test folder prefix
     * 
     * @var string 
     */
    protected static $cloudTestFolderPrefix = "ImagingAICloudTestPhp";

    /**
     * Original test data folder
     * 
     * @var string 
     */
    protected static $originalDataFolder = "ImagingAiSdk";

    /**
     * Search context ID
     * 
     * @var string
     */
    protected $searchContextId;

    /**
     * @before
     */
    public function initTest()
    {
        $this->searchContextId = $this->createSearchContext();
    }

    /**
     * @after
     */
    public function finalizeTest()
    {
        if ($this->searchContextId)
        {
            $this->deleteSearchContext($this->searchContextId);
        }

        if (self::$storageApi->getIsExist(
            new StorageRequests\GetIsExistRequest(self::$tempFolder, null, self::$testStorage))->getFileExist()->getIsExist())
        {
            self::$storageApi->deleteFolder(new StorageRequests\DeleteFolderRequest(self::$tempFolder, self::$testStorage, true));
        }
    }

    /**
     * Gets storage path
     *
     * @param string $imageName Image name
     * @param string $folder Folder
     * @return string
     */
    protected function getStoragePath($imageName, $folder = null)
    {
        if ($folder)
        {
            return $folder . "/" . $imageName;
        }
        else
        {
            return self::$originalDataFolder . "/" . $imageName;
        }
    }

    /**
     * Creates search context
     *
     * @return string
     */
    protected function createSearchContext()
    {
        $response = self::$asyncMode ?
            self::$imagingApi->postCreateSearchContextAsync(
                new ImagingRequests\PostCreateSearchContextRequest(null, null, null, self::$testStorage))->wait() :
            self::$imagingApi->postCreateSearchContext(
                new ImagingRequests\PostCreateSearchContextRequest(null, null, null, self::$testStorage));
        
        $this->assertEquals(200, $response->getCode());
        return $response->getId();
    }

    /**
     * Deletes search context
     *
     * @param string $searchContextId Search context ID
     * @return void
     */
    protected function deleteSearchContext($searchContextId)
    {
        if (self::$asyncMode)
        {
            self::$imagingApi->deleteSearchContextAsync(new ImagingRequests\DeleteSearchContextRequest($searchContextId, null, self::$testStorage))->wait();
        }
        else
        {
            self::$imagingApi->deleteSearchContext(new ImagingRequests\DeleteSearchContextRequest($searchContextId, null, self::$testStorage));
        }
    }

    /**
     * Gets search context status
     *
     * @param string $searchContextId Search context ID
     * @return string
     */
    protected function getSearchContextStatus($searchContextId)
    {
        $response = self::$asyncMode ?
            self::$imagingApi->getSearchContextStatusAsync(new ImagingRequests\GetSearchContextStatusRequest($searchContextId, null, self::$testStorage))->wait() :
            self::$imagingApi->getSearchContextStatus(new ImagingRequests\GetSearchContextStatusRequest($searchContextId, null, self::$testStorage));
        $this->assertEquals(200, $response->getCode());
        return $response->getSearchStatus();
    }

    /**
     * Adds image features to search context
     *
     * @param string $storageSourcePath
     * @param bool $isFolder
     * @return void
     */
    protected function addImageFeaturesToSearchContext($storageSourcePath, $isFolder = false)
    {
        $request = $isFolder ?
            new ImagingRequests\PostSearchContextExtractImageFeaturesRequest(
                $this->searchContextId, null, null, $storageSourcePath, null, self::$testStorage) :
            new ImagingRequests\PostSearchContextExtractImageFeaturesRequest(
                $this->searchContextId, null, $storageSourcePath, null, null, self::$testStorage);
        
        self::$asyncMode ? self::$imagingApi->postSearchContextExtractImageFeaturesAsync($request)->wait() :
            self::$imagingApi->postSearchContextExtractImageFeatures($request);

        $this->waitSearchContextIdle();
    }

    /**
     * Waits for search context idle state
     *
     * @param int $timeout Timeout in minutes
     * @return void
     */
    protected function waitSearchContextIdle($timeout = 5)
    {
        $sleepTime = 10;
        $startTime = new DateTime();

        $status = self::$asyncMode ? 
            self::$imagingApi->getSearchContextStatusAsync(
                new ImagingRequests\GetSearchContextStatusRequest($this->searchContextId, null, self::$testStorage))->wait()->getSearchStatus() :
            self::$imagingApi->getSearchContextStatus(
                new ImagingRequests\GetSearchContextStatusRequest($this->searchContextId, null, self::$testStorage))->getSearchStatus();

        while ($status !== "Idle" && date_diff(new DateTime(), $startTime)->format("%i") < $timeout)
        {
            sleep($sleepTime);
            $status = self::$asyncMode ? 
            self::$imagingApi->getSearchContextStatusAsync(
                new ImagingRequests\GetSearchContextStatusRequest($this->searchContextId, null, self::$testStorage))->wait()->getSearchStatus() :
            self::$imagingApi->getSearchContextStatus(
                new ImagingRequests\GetSearchContextStatusRequest($this->searchContextId, null, self::$testStorage))->getSearchStatus();  
        }
    }

    /**
     * Runs test with logging.
     *
     * @param string $testMethodWithParams String that holds test method name and params.
     * @param callable $testAction Test action.
     * @return void
     */
    protected function runTestWithLogging($testMethodWithParams, callable $testAction)
    {
        $passed = false;

        echo $testMethodWithParams . "\r\n";
        try
        {
            $testAction();
            $passed = true;
        }
        catch (Exception $ex)
        {
            echo $ex->getMessage() . "\r\n";
            throw $ex;
        }

        echo "Test passed: " . $passed . "\r\n";
    }
}
<?php
/**
 * --------------------------------------------------------------------------------------------------------------------
 * <copyright company="Aspose" file="ApiTester.php">
 *   Copyright (c) 2018-2019 Aspose Pty Ltd. All rights reserved.
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

namespace Aspose\Imaging\Tests\Base;

ini_set('memory_limit', '512M');

use \Aspose\Imaging;
use \Aspose\Imaging\Model;
use \Aspose\Imaging\Model\Requests;
use \PHPUnit\Framework\TestCase;
use \InvalidArgumentException;

/**
 * Base class for API tester
 */
abstract class ApiTester extends TestCase
{
    /**
     * The server access file
     * 
     * @var string 
     */
    const ServerAccessFile = "serverAccess.json";

    /**
     * The API version
     * 
     * @var string 
     */
    const ApiVersion = "v3.0";

    /**
     * The Client Secret
     * 
     * @var string 
     */
    const ClientSecret = "xxx";

    /**
     * The Client ID
     * 
     * @var string 
     */
    const ClientId = "xxx";

    /**
     * The base URL
     * 
     * @var string 
     */
    const BaseUrl = "http://api-qa.aspose.cloud/";

    /**
     * The local test folder
     * 
     * @var string 
     */
    const LocalTestFolder = "./testdata/";

    /**
     * The local test folder
     * 
     * @var string 
     */
    const DefaultStorage = "Imaging-CI";

    /**
     * The basic export formats
     * 
     * @var string[]
     */
    const BasicExportFormats = [ 
        "bmp",
        "gif",
        "jpg",
        "png",
        "psd",
        "tiff",
        "webp"
    ];

    /**
     * If any test failed
     * 
     * @var bool 
     */
    public static $failedAnyTest = false;

    /**
     * Gets extended test switch
     * @return bool true if extended tests should be executed
     */
    public static function getExtendedTests() {
        return getenv("ExtendedTests") === "true" ? true : false;
    }

    /**
     * Aspose.Imaging API
     * 
     * @var \Aspose\Imaging\ImagingApi
     */
    protected static $imagingApi;

    /**
     * If tests were initialized
     *
     * @var bool
     */
    protected static $initialized = false;
 
    /**
     * The temporary folder
     * 
     * @var string 
     */
    protected static $tempFolder;

    /**
     * The input test files
     *
     * @var \Aspose\Imaging\Model\StorageFile[]
     */
    protected static $inputTestFiles;

    /**
     * The basic input test files
     *
     * @var \Aspose\Imaging\Model\StorageFile[]
     */
    protected static $basicInputTestFiles;

    /**
     * The multipage input test files
     *
     * @var \Aspose\Imaging\Model\StorageFile[]
     */
    protected static $multipageInputTestFiles;

    /**
     * The test storage
     * 
     * @var string 
     */
    protected static $testStorage;

    /**
     * The cloud test folder prefix
     * 
     * @var string 
     */
    protected static $cloudTestFolderPrefix = "ImagingCloudTestPhp";

    /**
     * Whether resulting images should be removed from cloud storage
     * 
     * @var bool 
     */
    protected static $removeResult;

    /**
     * Original test data folder
     * 
     * @var string 
     */
    protected static $originalDataFolder = "ImagingIntegrationTestData";

    /**
     * @beforeClass
     */
    public static function initFixture()
    {
        echo "\r\n";
        echo "Extended tests: " . (self::getExtendedTests() ? "true" : "false") . "\r\n";
        $buildNumber = getenv("BUILD_NUMBER");
        if (!empty($buildNumber))
        {
            self::$tempFolder = self::$cloudTestFolderPrefix . '_' . $buildNumber;
        }
        else
        {
            self::$tempFolder = self::$cloudTestFolderPrefix . '_' . get_current_user();
        }

        self::$testStorage = getenv("StorageName");

        if (empty(self::$testStorage))
        {
            echo "Storage name is not set by environment variable. Using the default one.\r\n";
            self::$testStorage = ApiTester::DefaultStorage;
        }

        self::createApiInstances();
        if (!self::$failedAnyTest && self::$removeResult && self::$imagingApi->objectExists(
            new Requests\ObjectExistsRequest(self::$tempFolder, self::$testStorage))->getExists())
        {
            self::$imagingApi->deleteFolder(new Requests\DeleteFolderRequest(self::$tempFolder, self::$testStorage, true));
            self::$imagingApi->createFolder(new Requests\CreateFolderRequest(self::$tempFolder, self::$testStorage, self::$testStorage));
        }

        self::$initialized = true;
    }

    /**
     * @afterClass
     */
    public static function finalizeFixture()
    {
        if (!self::$failedAnyTest && self::$removeResult && self::$imagingApi->objectExists(
            new Requests\ObjectExistsRequest(self::$tempFolder, self::$testStorage))->getExists())
        {
            self::$imagingApi->deleteFolder(new Requests\DeleteFolderRequest(self::$tempFolder, self::$testStorage, true));
        }
    }

    /**
     * Creates the API instances using given access parameters.
     *
     * @return void
     */
    protected static function createApiInstances()
    {
        echo "Trying to obtain access creds environment variables.\r\n";
        $onPremise = getenv("OnPremise") === "true";
        $clientSecret = $onPremise ? '' : getenv("ClientSecret");
        $clientId = $onPremise ? '' : getenv("ClientId");
        $baseUrl = getenv("ApiEndpoint");
        $apiVersion = getenv("ApiVersion");

        if ((!$onPremise && (empty($clientSecret) || empty($clientId))) || empty($baseUrl) || empty($apiVersion))
        {
            echo "Access data isn't set completely by environment variables. Filling unset data with default values.\r\n";
        }

        if (empty($apiVersion))
        {
            $apiVersion = ApiTester::ApiVersion;
            echo "Set default API version\r\n";
        }
        
        $serverAccessPath = ApiTester::LocalTestFolder . ApiTester::ServerAccessFile;
        $serverAccessString = null;
        if (file_exists($serverAccessPath))
        {
            $serverAccessString = file_get_contents($serverAccessPath);
        }

        if (!empty($serverAccessString))
        {
            $accessData = json_decode($serverAccessString);
            if (empty($clientSecret) && !$onPremise)
            {
                $clientSecret = $accessData->{'ClientSecret'};
                echo "Set default Client Secret\r\n";
            }

            if (empty($clientId) && !$onPremise)
            {
                $clientId = $accessData->{'ClientId'};
                echo "Set default Client ID\r\n";
            }

            if (empty($baseUrl))
            {
                $baseUrl = $accessData->{'BaseURL'};
                echo "Set default base URL\r\n";
            }
        }
        else if (!$onPremise)
        {
            throw new InvalidArgumentException("Please, specify valid access data (ClientSecret, ClientId, Base URL)");
        }

        echo "On-premise: " . var_export($onPremise, true) . "\r\n";
        echo "Client Secret: " . $clientSecret . "\r\n";
        echo "Client ID: " . $clientId . "\r\n";
        echo "Storage: " . self::$testStorage . "\r\n";
        echo "Base URL: " . $baseUrl . "\r\n";
        echo "API version: " . $apiVersion . "\r\n";

        $imagingConfig = new Imaging\Configuration();
        $imagingConfig->setBaseUrl($baseUrl);
        $imagingConfig->setClientSecret($clientSecret);
        $imagingConfig->setClientId($clientId);
        $imagingConfig->setApiVersion($apiVersion);
        $imagingConfig->setOnPremise($onPremise);
        self::$imagingApi = new Imaging\ImagingApi($imagingConfig);
        self::$inputTestFiles = self::fetchInputTestFilesInfo();
        self::$basicInputTestFiles = array_filter(self::$inputTestFiles, function ($file) {
            return substr($file->getName(), 0, strlen("multipage_")) !== "multipage_";
        });
        self::$multipageInputTestFiles = array_filter(self::$inputTestFiles, function ($file) {
            return substr($file->getName(), 0, strlen("multipage_")) === "multipage_";
        });
    }
    
    /**
     * Fetches the input test files info.
     *
     * @return Model\StorageFile[]
     */
    private static function fetchInputTestFilesInfo()
    {
        $filesResponse = self::$imagingApi->getFilesList(new Requests\GetFilesListRequest(self::$originalDataFolder, self::$testStorage));
        return $filesResponse->getValue();
    }

    /**
     * Storage options provider
     *
     * @return array
     */
    public function storageOptionsProvider()
    {
        return [
            [true],
            [false]
        ];
    }

    /**
     * Tests the typical GET request.
     *
     * @param string $testMethodName Name of the test method.
     * @param string $parametersLine The parameters line.
     * @param string $inputFileName Name of the input file.
     * @param callable $requestInvoker The request invoker.
     * @param callable $propertiesTester The properties tester.
     * @param string $folder The folder.
     * @param string $storage The storage.
     * @return void
     */
    protected function getRequestTestInternal($testMethodName, $parametersLine, $inputFileName, 
        callable $requestInvoker, callable $propertiesTester, $folder, $storage)
    {
        $this->requestTestInternal($testMethodName, false, $parametersLine, $inputFileName, null, 
            function() use ($requestInvoker) 
            {
                return $this->obtainGetResponse($requestInvoker);
            },
            $propertiesTester, $folder, $storage);
    }

    protected function getObjectDetectionRequestTestInternal($testMethodName, $parametersLine, $inputFileName,
                                              callable $requestInvoker, callable $propertiesTester, $folder, $storage)
    {
        $this->requestObjectDetectionTestInternal($testMethodName, false, $parametersLine, $inputFileName, null,
            function() use ($requestInvoker)
            {
                return $this->obtainObjectDetectionGetResponse($requestInvoker);
            },
            $propertiesTester, $folder, $storage);
    }

    /**
     * Tests the typical POST request.

     * @param string $testMethodName Name of the test method.
     * @param bool $saveResultToStorage If save result to storage.
     * @param string $parametersLine The parameters line.
     * @param string $inputFileName Name of the input file.
     * @param string $resultFileName Name of the result file.
     * @param callable $requestInvoker The request invoker.
     * @param callable $propertiesTester The properties tester.
     * @param string $folder The folder.
     * @param string $storage The storage.
     * @return void
     */
    protected function postRequestTestInternal($testMethodName, $saveResultToStorage, $parametersLine, $inputFileName, $resultFileName, 
        callable $requestInvoker, callable $propertiesTester, $folder, $storage)
    {
        $this->requestTestInternal($testMethodName, $saveResultToStorage, $parametersLine, $inputFileName, $resultFileName,
            function() use ($inputFileName, $saveResultToStorage, $folder, $resultFileName, $storage, $requestInvoker) 
            {
                return $this->obtainPostResponse($folder . "/" . $inputFileName, $saveResultToStorage ? $folder . "/" . $resultFileName : null, $storage, $requestInvoker);
            },
            $propertiesTester, $folder, $storage);
    }

    /**
     * Tests the typical POST request.

     * @param string $testMethodName Name of the test method.
     * @param bool $saveResultToStorage If save result to storage.
     * @param string $parametersLine The parameters line.
     * @param string $inputFileName Name of the input file.
     * @param string $resultFileName Name of the result file.
     * @param callable $requestInvoker The request invoker.
     * @param callable $propertiesTester The properties tester.
     * @param string $folder The folder.
     * @param string $storage The storage.
     * @return void
     */
    protected function postObjectDetectionRequestTestInternal($testMethodName, $saveResultToStorage, $parametersLine, $inputFileName, $resultFileName,
                                               callable $requestInvoker, callable $propertiesTester, $folder, $storage)
    {
        $this->requestObjectDetectionTestInternal($testMethodName, $saveResultToStorage, $parametersLine, $inputFileName, $resultFileName,
            function() use ($inputFileName, $saveResultToStorage, $folder, $resultFileName, $storage, $requestInvoker)
            {
                return $this->obtainObjectDetectionPostResponse($folder . "/" . $inputFileName, $saveResultToStorage ? $folder . "/" . $resultFileName : null, $storage, $requestInvoker);
            },
            $propertiesTester, $folder, $storage);
    }

    /**
     * Checks if input file exists.
     *
     * @param string $inputFileName Name of the input file.
     * @return bool
     */
    protected function checkInputFileExists($inputFileName)
    {
        foreach (self::$inputTestFiles as $storageFileInfo)
        {
            if ($storageFileInfo->getName() == $inputFileName)
            {
                return true;
            }
        }

        return false;
    }

    /**
     * Copies original input file to test folder in cloud
     * @param string $inputFileName The input file name
     * @param string $folder The folder
     * @param string $storage The storage
     */
    protected function copyInputFileToTestFolder($inputFileName, $folder, $storage)
    {
        if (!$this->checkInputFileExists($inputFileName))
        {
            throw new ArgumentException(
                "Input file " . $inputFileName . " doesn't exist in the specified storage folder: " . $folder . ". Please, upload it first.");
        }

        if (!self::$imagingApi->objectExists(new Requests\ObjectExistsRequest($folder . "/" . $inputFileName, $storage))->getExists())
        {
            self::$imagingApi->copyFile(
                new Requests\CopyFileRequest(self::$originalDataFolder . "/" . $inputFileName, $folder . "/" . $inputFileName, $storage, $storage));
        }
    }

    /**
     * Gets the storage file information.
     *
     * @param string $folder The folder which contains a file.
     * @param string $fileName Name of the file.
     * @param string $storage The storage.
     * @return Model\StorageFile
     */
    protected function getStorageFileInfo($folder, $fileName, $storage)
    {
        $fileListResponse = self::$imagingApi->getFilesList(new Requests\GetFilesListRequest($folder, $storage));
        foreach ($fileListResponse->getValue() as $storageFileInfo)
        {
            if ($storageFileInfo->getName() === $fileName)
            {
                return $storageFileInfo;
            }
        }

        return null;
    }

    /**
     * Obtains the typical GET request response.
     *
     * @param mixed $requestInvoker Request invoker.
     * @return \Psr\Http\Message\StreamInterface
     */
    private function obtainGetResponse($requestInvoker)
    {
        $response = $requestInvoker();
        $this->assertNotNull($response);
        $this->assertGreaterThan(0, $response->getSize());
        return $response;
    }

    private function obtainObjectDetectionGetResponse($requestInvoker)
    {
        return $requestInvoker();
    }

    /**
     * Obtains the typical POST request response.
     *
     * @param string $inputPath The input path.
     * @param string $outPath The output path to save the result.
     * @param string $storage The storage.
     * @param callable $requestInvoker The request invoker.
     * @return Psr\Http\Message\StreamInterface
     */
    private function obtainPostResponse($inputPath, $outPath, $storage, callable $requestInvoker)
    {
        $downContents = self::$imagingApi->downloadFile(new Requests\DownloadFileRequest($inputPath, $storage));
        $response = $requestInvoker($downContents->getContents(), $outPath);
        if (!isset($outPath))
        {
            $this->assertNotNull($response);
            $this->assertGreaterThan(0, $response->getSize());
            return $response;
        }

        return null;
    }

    /**
     * Obtains the typical POST request response.
     *
     * @param string $inputPath The input path.
     * @param string $outPath The output path to save the result.
     * @param string $storage The storage.
     * @param callable $requestInvoker The request invoker.
     * @return Psr\Http\Message\StreamInterface
     */
    private function obtainObjectDetectionPostResponse($inputPath, $outPath, $storage, callable $requestInvoker)
    {
        $downContents = self::$imagingApi->downloadFile(new Requests\DownloadFileRequest($inputPath, $storage));
        return $requestInvoker($downContents->getContents(), $outPath);
    }

    /**
     * Tests the typical request.
     *
     * @param string $testMethodName Name of the test method.
     * @param bool $saveResultToStorage If save result to storage.
     * @param string $parametersLine The parameters line.
     * @param string $inputFileName Name of the input file.
     * @param string $resultFileName Name of the result file.
     * @param callable $invokeRequestAction The invoke request action.
     * @param callable $propertiesTester The properties tester.
     * @param string $folder The folder.
     * @param string $storage The storage.
     * @return void
     */
    private function requestTestInternal($testMethodName, $saveResultToStorage, $parametersLine, $inputFileName, $resultFileName, 
        callable $invokeRequestAction, callable $propertiesTester, $folder, $storage)
    {
        echo "\r\n" . $testMethodName . "; save result to storage: " . var_export($saveResultToStorage, true) . "\r\n";

        self::copyInputFileToTestFolder($inputFileName, $folder, $storage);

        $passed = false;
        $outPath = null;

        try
        {
            echo $parametersLine . "\r\n";

            if ($saveResultToStorage)
            {
                $outPath = $folder . "/" . $resultFileName;

                // remove output file from the storage (if exists)
                if (self::$imagingApi->objectExists(new Requests\ObjectExistsRequest($outPath, $storage))->getExists())
                {
                    self::$imagingApi->deleteFile(new Requests\DeleteFileRequest($outPath, $storage));
                }
            }

            $resultProperties = null;
            $response = $invokeRequestAction();

            if ($saveResultToStorage)
            {
                $resultInfo = $this->getStorageFileInfo($folder, $resultFileName, $storage);
                if (!isset($resultInfo))
                {
                    throw new ArgumentException(
                        "Result file " . $resultFileName . " doesn't exist in the specified storage folder: "
                        . $folder . "Result isn't present in the storage by an unknown reason.");
                }

                if (substr($resultFileName, -strlen(".pdf")) !== ".pdf") {
                    $resultProperties =
                        self::$imagingApi->getImagePropertiesAsync(
                            new Requests\GetImagePropertiesRequest($resultFileName, $folder, $storage))->wait();
                    $this->assertNotNull($resultProperties);
                }
            }
            elseif (!$this->fileIsPdf($response))
            {
                $response->rewind();
                $resultProperties =
                    self::$imagingApi->extractImagePropertiesAsync(
                        new Requests\ExtractImagePropertiesRequest($response->getContents()))->wait();
                $this->assertNotNull($resultProperties);
            }

            $originalProperties = 
                self::$imagingApi->getImagePropertiesAsync(
                    new Requests\GetImagePropertiesRequest($inputFileName, $folder, $storage))->wait();
            $this->assertNotNull($originalProperties);

            if (isset($resultProperties) && isset($propertiesTester))
            {
                $propertiesTester($originalProperties, $resultProperties, $response);
            }
                
            $passed = true;
        }
        catch (Exception $ex)
        {
            self::$failedAnyTest = true;
            echo $ex->getMessage() . "\r\n";
            throw $ex;
        }
        finally
        {
            if ($passed && $saveResultToStorage && self::$removeResult && self::$imagingApi->objectExists(
                new Requests\ObjectExistsRequest($outPath, $storage))->getExists())
            {
                self::$imagingApi->deleteFile(new Requests\DeleteFileRequest($outPath, $storage));
            }

            echo "Test passed: " . var_export($passed, true) . "\r\n";
        }
    }

    private function requestObjectDetectionTestInternal(
        $testMethodName,
        $saveResultToStorage,
        $parametersLine,
        $inputFileName,
        $resultFileName,
        callable $invokeRequestAction,
        callable $propertiesTester,
        $folder,
        $storage)
    {
        echo "\r\n" . $testMethodName . "; save result to storage: " . var_export($saveResultToStorage, true) . "\r\n";

        if (!$this->checkInputFileExists($inputFileName))
        {
            throw new ArgumentException(
                "Input file " . $inputFileName . " doesn't exist in the specified storage folder: " . $folder . ". Please, upload it first.");
        }

        if (!self::$imagingApi->objectExists(new Requests\ObjectExistsRequest($folder . "/" . $inputFileName, $storage))->getExists())
        {
            self::$imagingApi->copyFile(
                new Requests\CopyFileRequest(self::$originalDataFolder . "/" . $inputFileName, $folder . "/" . $inputFileName, $storage, $storage));
        }

        $passed = false;
        $outPath = null;

        try
        {
            echo $parametersLine . "\r\n";

            if ($saveResultToStorage)
            {
                $outPath = $folder . "/" . $resultFileName;

                // remove output file from the storage (if exists)
                if (self::$imagingApi->objectExists(new Requests\ObjectExistsRequest($outPath, $storage))->getExists())
                {
                    self::$imagingApi->deleteFile(new Requests\DeleteFileRequest($outPath, $storage));
                }
            }

            $response = $invokeRequestAction();

            if ($saveResultToStorage)
            {
                $resultInfo = $this->getStorageFileInfo($folder, $resultFileName, $storage);
                if (!isset($resultInfo))
                {
                    throw new ArgumentException(
                        "Result file " . $resultFileName . " doesn't exist in the specified storage folder: "
                        . $folder . "Result isn't present in the storage by an unknown reason.");
                }
            }

            if (isset($propertiesTester))
            {
                $propertiesTester($response);
            }

            $passed = true;
        }
        catch (Exception $ex)
        {
            self::$failedAnyTest = true;
            echo $ex->getMessage() . "\r\n";
            throw $ex;
        }
        finally
        {
            if ($passed && $saveResultToStorage && self::$removeResult && self::$imagingApi->objectExists(
                    new Requests\ObjectExistsRequest($outPath, $storage))->getExists())
            {
                self::$imagingApi->deleteFile(new Requests\DeleteFileRequest($outPath, $storage));
            }

            echo "Test passed: " . var_export($passed, true) . "\r\n";
        }
    }

    /**
     * Checks that stream represents PDF file
     *
     * @param $file \GuzzleHttp\Psr7\Stream The file stream
     * @return bool true if file is a PSD
     */
    private function fileIsPdf($file) {
        $buffer = unpack('C*', $file->read(5));
        // This is the 1-indexed array, not a mistake
        return $buffer[1] == 0x25 && $buffer[2] == 0x50 && $buffer[3] == 0x44 && $buffer[4] == 0x46 &&
            $buffer[5] == 0x2d;
    }
}

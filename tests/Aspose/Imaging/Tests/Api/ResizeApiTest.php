<?php
/**
 * --------------------------------------------------------------------------------------------------------------------
 * <copyright company="Aspose" file="ResizeApiTest.php">
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

namespace Aspose\Imaging\Tests\Api;

use \Aspose\Imaging\Tests\Base\ApiTester;
use \Aspose\Imaging;
use \Aspose\Imaging\Model;
use \Aspose\Imaging\Model\Requests;
use \PHPUnit\Framework\TestCase;
use \GuzzleHttp\Stream;

/**
 * Class for testing ResizeApi
 * 
 * @group Imaging
 * @group v1.0
 * @group v2.0
 * @group Resize
 */
class ResizeApiTest extends ApiTester
{
    /**
     * Export options provider
     *
     * @return array
     */
    public function exportOptionsProvider()
    {
        return [
            [".bmp", true],  [".bmp", false], 
            [".dicom", true], [".dicom", false], 
            /* TODO: enable after IMAGINGCLOUD-51 is resolved
            [".gif", true], [".gif", false], 
            */
            [".j2k", true], [".j2k", false],
            [".png", true], [".png", false],
            [".psd", true], [".psd", false],
            [".jpg", true], [".jpg", false],
            [".tiff", true], [".tiff", false],
            [".webp", true], [".webp", false]
        ];
    }

    /**
     * Test GetImageResize
     * 
     * @test
     * @dataProvider exportOptionsProvider
     *
     * @param string $formatExtension Format extension to search for input images in the test folder.
     * @param bool $saveResultToStorage If result should be saved to storage.
     * @param array $additionalExportFormats Additional formats to export to.
     * @return void
    */
    public function getImageResizeTest($formatExtension, $saveResultToStorage, $additionalExportFormats = [])
    {
        $name = null;
        $newWidth = 100;
        $newHeight = 150;
        $folder = self::$tempFolder;
        $storage = self::$testStorage;
        $outName = null;

        $formatsToExport = ApiTester::BasicExportFormats;
        foreach($additionalExportFormats as $additionalExportFormat)
        {
            if (!in_array($additionalExportFormat, $formatsToExport))
            {
                $formatsToExport[] = $additionalExportFormat;
            }
        }

        foreach (self::$inputTestFiles as $inputFile)
        {
            $inputFileName = $inputFile->getName();
            if (substr($inputFileName, -strlen($formatExtension), strlen($formatExtension)) === $formatExtension)
            {
                $name = $inputFileName;
            }
            else
            {
                continue;
            }

            foreach ($formatsToExport as $format)
            {
                $outName = $name . "_resize." . $format;

                $this->getRequestTestInternal(
                    "getImageResizeTest", 
                    $saveResultToStorage,
                    "Input image: " . $name . "; Output format: " . $format . "; New width: " . $newWidth . "; New height: " . $newHeight,
                    $name,
                    $outName,
                    function($fileName, $outPath) use ($format, $newWidth, $newHeight, $folder, $storage)
                    {
                        $request = new Requests\GetImageResizeRequest($fileName, $format, $newWidth, $newHeight, $outPath, $folder, $storage);
                        return self::$asyncMode ? self::$imagingApi->getImageResizeAsync($request)->wait() : self::$imagingApi->getImageResize($request);
                    },
                    function($originalProperties, $resultProperties, $resultStream) use ($newWidth, $newHeight)
                    {
                        $this->assertEquals($newWidth, $resultProperties->getWidth());
                        $this->assertEquals($newHeight, $resultProperties->getHeight());
                    },
                    $folder,
                    $storage);
            }
        }
    }

    /**
     * Test PostImageResize
     * 
     * @test
     * @dataProvider exportOptionsProvider
     *
     * @param string $formatExtension Format extension to search for input images in the test folder.
     * @param bool $saveResultToStorage If result should be saved to storage.
     * @param array $additionalExportFormats Additional formats to export to.
     * @return void
    */
    public function postImageResizeTest($formatExtension, $saveResultToStorage, $additionalExportFormats = [])
    {
        $name = null;
        $newWidth = 100;
        $newHeight = 150;
        $folder = self::$tempFolder;
        $storage = self::$testStorage;
        $outName = null;

        $formatsToExport = ApiTester::BasicExportFormats;
        foreach($additionalExportFormats as $additionalExportFormat)
        {
            if (!in_array($additionalExportFormat, $formatsToExport))
            {
                $formatsToExport[] = $additionalExportFormat;
            }
        }

        foreach (self::$inputTestFiles as $inputFile)
        {
            $inputFileName = $inputFile->getName();
            if (substr($inputFileName, -strlen($formatExtension), strlen($formatExtension)) === $formatExtension)
            {
                $name = $inputFileName;
            }
            else
            {
                continue;
            }

            foreach ($formatsToExport as $format)
            {
                $outName = $name . "_resize." . $format;

                $this->postRequestTestInternal(
                    "postImageResizeTest", 
                    $saveResultToStorage,
                    "Input image: " . $name . "; Output format: " . $format . "; New width: " . $newWidth . "; New height: " . $newHeight,
                    $name,
                    $outName,
                    function($inputStream, $outPath) use ($format, $newWidth, $newHeight, $storage)
                    {
                        $request = new Requests\PostImageResizeRequest($inputStream, $format, $newWidth, $newHeight, $outPath, $storage);
                        return self::$asyncMode ? self::$imagingApi->postImageResizeAsync($request)->wait() : self::$imagingApi->postImageResize($request);
                    },
                    function($originalProperties, $resultProperties, $resultStream) use ($newWidth, $newHeight)
                    {
                        $this->assertEquals($newWidth, $resultProperties->getWidth());
                        $this->assertEquals($newHeight, $resultProperties->getHeight());
                    },
                    $folder,
                    $storage);
            }
        }
    }
}
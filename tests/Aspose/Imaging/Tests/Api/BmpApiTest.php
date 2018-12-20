<?php
/**
 * --------------------------------------------------------------------------------------------------------------------
 * <copyright company="Aspose" file="BmpApiTest.php">
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
 * Class for testing BmpApi
 * 
 * @group Imaging
 * @group v1.0
 * @group v2.0
 * @group Bmp
 */
class BmpApiTest extends ApiTester
{
    /**
     * Test GetImageBmp
     * 
     * @test
     * @dataProvider storageOptionsProvider
     *
     * @param bool $saveResultToStorage If result should be saved to storage.
     * @return void
    */
    public function getImageBmpTest($saveResultToStorage)
    {
        $name = "test.bmp";
        $bitsPerPixel = 32;
        $horizontalResolution = 300;
        $verticalResolution = 300;
        $fromScratch = null;
        $outName = $name . "_specific.bmp";
        $folder = self::$tempFolder;
        $storage = self::$testStorage;

        $this->getRequestTestInternal(
            "getImageBmpTest", 
            $saveResultToStorage,
            "Input image: " . $name . "; Bits per pixel: " . $bitsPerPixel . "; Horizontal resolution: " . $horizontalResolution . ";
                Vertical resolution: " . $verticalResolution,
            $name,
            $outName,
            function($fileName, $outPath) use ($bitsPerPixel, $horizontalResolution, $verticalResolution, $fromScratch, $folder, $storage)
            {
                $request = new Requests\GetImageBmpRequest($fileName, $bitsPerPixel, $horizontalResolution, $verticalResolution, $fromScratch, $outPath, $folder, $storage);
                return self::$asyncMode === true ? self::$imagingApi->getImageBmpAsync($request)->wait() : self::$imagingApi->getImageBmp($request);
            },
            function($originalProperties, $resultProperties, $resultStream) use ($bitsPerPixel, $horizontalResolution, $verticalResolution)
            {
                $this->assertNotNull($resultProperties->getBmpProperties());
                $this->assertEquals($bitsPerPixel, $resultProperties->getBitsPerPixel());
                $this->assertEquals($verticalResolution, ceil($resultProperties->getVerticalResolution()));
                $this->assertEquals($horizontalResolution, ceil($resultProperties->getHorizontalResolution()));

                $this->assertNotNull($originalProperties->getBmpProperties());
                $this->assertEquals($originalProperties->getBmpProperties()->getCompression(), $resultProperties->getBmpProperties()->getCompression());
                $this->assertEquals($originalProperties->getWidth(), $resultProperties->getWidth());
                $this->assertEquals($originalProperties->getHeight(), $resultProperties->getHeight());
            },
            $folder,
            $storage);
    }

    /**
     * Test PostImageBmp
     * 
     * @test
     * @dataProvider storageOptionsProvider
     *
     * @param bool $saveResultToStorage If result should be saved to storage.
     * @return void
    */
    public function postImageBmpTest($saveResultToStorage)
    {
        $name = "test.bmp";
        $bitsPerPixel = 32;
        $horizontalResolution = 300;
        $verticalResolution = 300;
        $fromScratch = null;
        $outName = $name . "_specific.bmp";
        $folder = self::$tempFolder;
        $storage = self::$testStorage;

        $this->postRequestTestInternal(
            "postImageBmpTest", 
            $saveResultToStorage,
            "Input image: " . $name . "; Bits per pixel: " . $bitsPerPixel . "; Horizontal resolution: " . $horizontalResolution . ";
                Vertical resolution: " . $verticalResolution,
            $name,
            $outName,
            function($inputStream, $outPath) use ($bitsPerPixel, $horizontalResolution, $verticalResolution, $fromScratch, $storage)
            {
                $request = new Requests\PostImageBmpRequest($inputStream, $bitsPerPixel, $horizontalResolution, $verticalResolution, $fromScratch, $outPath, $storage);
                return self::$asyncMode === true ? self::$imagingApi->postImageBmpAsync($request)->wait() : self::$imagingApi->postImageBmp($request);
            },
            function($originalProperties, $resultProperties, $resultStream) use ($bitsPerPixel, $horizontalResolution, $verticalResolution)
            {
                $this->assertNotNull($resultProperties->getBmpProperties());
                $this->assertEquals($bitsPerPixel, $resultProperties->getBitsPerPixel());
                $this->assertEquals($verticalResolution, ceil($resultProperties->getVerticalResolution()));
                $this->assertEquals($horizontalResolution, ceil($resultProperties->getHorizontalResolution()));

                $this->assertNotNull($originalProperties->getBmpProperties());
                $this->assertEquals($originalProperties->getBmpProperties()->getCompression(), $resultProperties->getBmpProperties()->getCompression());
                $this->assertEquals($originalProperties->getWidth(), $resultProperties->getWidth());
                $this->assertEquals($originalProperties->getHeight(), $resultProperties->getHeight());
            },
            $folder,
            $storage);
    }
}
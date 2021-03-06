<?php
/**
 * --------------------------------------------------------------------------------------------------------------------
 * <copyright company="Aspose" file="GifApiTest.php">
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

namespace Aspose\Imaging\Tests\Api;

use \Aspose\Imaging\Tests\Base\ApiTester;
use \Aspose\Imaging\Model\Requests;

/**
 * Class for testing GifApi
 * 
 * @group Imaging
 * @group v3.0
 * @group Gif
 */
class GifApiTest extends ApiTester
{
    /**
     * Test ModifyGif
     * 
     * @test
     *
     * @return void
    */
    public function modifyGifTest()
    {
        $name = "test.gif";
        $backgroundColorIndex = 5;
        $colorResolution = 4;
        $hasTrailer = true;
        $interlaced = false;
        $isPaletteSorted = true;
        $pixelAspectRatio = 4;
        $fromScratch = null;
        $folder = self::$tempFolder;
        $storage = self::$testStorage;

        $this->getRequestTestInternal(
            "modifyGifTest", 
            "Input image: " . $name . "; Back color index: " . $backgroundColorIndex . "; Color resolution width: " . $colorResolution . ";
                Has trailer: " . $hasTrailer . "; Interlaced: " . $interlaced . "; Is palette sorted: " . $isPaletteSorted . "; 
                Pixel aspect ratio" . $pixelAspectRatio,
            $name,
            function() use ($name, $backgroundColorIndex, $colorResolution, $hasTrailer, $interlaced, $isPaletteSorted, 
                $pixelAspectRatio, $fromScratch, $folder, $storage)
            {
                $request = new Requests\ModifyGifRequest($name, $backgroundColorIndex, $colorResolution, $hasTrailer, $interlaced, 
                    $isPaletteSorted, $pixelAspectRatio, $fromScratch, $folder, $storage);
                return self::$imagingApi->modifyGifAsync($request)->wait();
            },
            function($originalProperties, $resultProperties, $resultStream) use ($backgroundColorIndex, $colorResolution, $hasTrailer, $interlaced, 
                $isPaletteSorted, $pixelAspectRatio)
            {
                $this->assertNotNull($resultProperties->getGifProperties());
                // TODO: enable when IMAGINGCLOUD-51 is done
                // $this->assertEquals($hasTrailer, $resultProperties->getGifProperties()->getHasTrailer());
                $this->assertEquals($pixelAspectRatio, $resultProperties->getGifProperties()->getPixelAspectRatio());

                $this->assertNotNull($originalProperties->getGifProperties());
                $this->assertEquals($originalProperties->getWidth(), $resultProperties->getWidth());
                $this->assertEquals($originalProperties->getHeight(), $resultProperties->getHeight());
            },
            $folder,
            $storage);
    }

    /**
     * Test CreateModifiedGif
     * 
     * @test
     * @dataProvider storageOptionsProvider
     *
     * @param bool $saveResultToStorage If result should be saved to storage.
     * @return void
    */
    public function createModifiedGifTest($saveResultToStorage)
    {
        $name = "test.gif";
        $backgroundColorIndex = 5;
        $colorResolution = 4;
        $hasTrailer = true;
        $interlaced = false;
        $isPaletteSorted = true;
        $pixelAspectRatio = 4;
        $fromScratch = null;
        $outName = $name . "_specific.gif";
        $folder = self::$tempFolder;
        $storage = self::$testStorage;

        $this->postRequestTestInternal(
            "createModifiedGifTest", 
            $saveResultToStorage,
            "Input image: " . $name . "; Back color index: " . $backgroundColorIndex . "; Color resolution width: " . $colorResolution . ";
                Has trailer: " . $hasTrailer . "; Interlaced: " . $interlaced . "; Is palette sorted: " . $isPaletteSorted . "; 
                Pixel aspect ratio" . $pixelAspectRatio,
            $name,
            $outName,
            function($inputStream, $outPath) use ($backgroundColorIndex, $colorResolution, $hasTrailer, $interlaced, $isPaletteSorted, 
                $pixelAspectRatio, $fromScratch, $storage)
            {
                $request = new Requests\CreateModifiedGifRequest($inputStream, $backgroundColorIndex, $colorResolution, $hasTrailer, $interlaced, 
                    $isPaletteSorted, $pixelAspectRatio, $fromScratch, $outPath, $storage);
                return self::$imagingApi->createModifiedGifAsync($request)->wait();
            },
            function($originalProperties, $resultProperties, $resultStream) use ($backgroundColorIndex, $colorResolution, $hasTrailer, $interlaced, 
                $isPaletteSorted, $pixelAspectRatio)
            {
                $this->assertNotNull($resultProperties->getGifProperties());
                // TODO: enable when IMAGINGCLOUD-51 is done
                // $this->assertEquals($hasTrailer, $resultProperties->getGifProperties()->getHasTrailer());
                $this->assertEquals($pixelAspectRatio, $resultProperties->getGifProperties()->getPixelAspectRatio());

                $this->assertNotNull($originalProperties->getGifProperties());
                $this->assertEquals($originalProperties->getWidth(), $resultProperties->getWidth());
                $this->assertEquals($originalProperties->getHeight(), $resultProperties->getHeight());
            },
            $folder,
            $storage);
    }
}

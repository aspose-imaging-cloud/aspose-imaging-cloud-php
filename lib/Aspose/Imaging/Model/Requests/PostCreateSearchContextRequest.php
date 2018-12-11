<?php
/**
 * --------------------------------------------------------------------------------------------------------------------
 * <copyright company="Aspose" file="PostCreateSearchContextRequest.php">
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

namespace Aspose\Imaging\Model\Requests;

use \InvalidArgumentException;
use Aspose\Imaging\Configuration;

/*
 * Request model for postCreateSearchContext operation.
 */
class PostCreateSearchContextRequest extends ImagingRequest
{
    /*
     * The image features detector.
     */
    public $detector;
	
    /*
     * The matching algorithm.
     */
    public $matching_algorithm;
	
    /*
     * The folder.
     */
    public $folder;
	
    /*
     * The storage.
     */
    public $storage;
    
    /*
     * Initializes a new instance of the PostCreateSearchContextRequest class.
     *  
     * @param string $detector The image features detector.
     * @param string $matching_algorithm The matching algorithm.
     * @param string $folder The folder.
     * @param string $storage The storage.
     */
    public function __construct($detector = null, $matching_algorithm = null, $folder = null, $storage = null)             
    {
        parent::__construct();
        $this->detector = $detector;
        $this->matching_algorithm = $matching_algorithm;
        $this->folder = $folder;
        $this->storage = $storage;
    }

    /*
     * The image features detector.
     */
    public function get_detector()
    {
        return $this->detector;
    }

    /*
     * The image features detector.
     */
    public function set_detector($value)
    {
        $this->detector = $value;
        return $this;
    }
	
    /*
     * The matching algorithm.
     */
    public function get_matching_algorithm()
    {
        return $this->matching_algorithm;
    }

    /*
     * The matching algorithm.
     */
    public function set_matching_algorithm($value)
    {
        $this->matching_algorithm = $value;
        return $this;
    }
	
    /*
     * The folder.
     */
    public function get_folder()
    {
        return $this->folder;
    }

    /*
     * The folder.
     */
    public function set_folder($value)
    {
        $this->folder = $value;
        return $this;
    }
	
    /*
     * The storage.
     */
    public function get_storage()
    {
        return $this->storage;
    }

    /*
     * The storage.
     */
    public function set_storage($value)
    {
        $this->storage = $value;
        return $this;
    }

    /*
     * Prepares initial info for HTTP request
     *
     * @param Configuration $config Imaging API configuration.
     */
    public function getHttpRequestInfo(Configuration $config)
    {

        $resourcePath = '/imaging/ai/imageSearch/create';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $multipart = false;
    

        // query params
        if ($this->detector !== null) {
            $localName = lcfirst('detector');
            $localValue = is_bool($this->detector) ? ($this->detector ? 'true' : 'false') : $this->detector;
            if (strpos($resourcePath, '{' . $localName . '}') !== false) {
                $resourcePath = str_replace('{' . $localName . '}', ObjectSerializer::toPathValue($localValue), $resourcePath);
            } else {
                $queryParams[$localName] = ObjectSerializer::toQueryValue($localValue);
            }
        }
        // query params
        if ($this->matching_algorithm !== null) {
            $localName = lcfirst('matchingAlgorithm');
            $localValue = is_bool($this->matching_algorithm) ? ($this->matching_algorithm ? 'true' : 'false') : $this->matching_algorithm;
            if (strpos($resourcePath, '{' . $localName . '}') !== false) {
                $resourcePath = str_replace('{' . $localName . '}', ObjectSerializer::toPathValue($localValue), $resourcePath);
            } else {
                $queryParams[$localName] = ObjectSerializer::toQueryValue($localValue);
            }
        }
        // query params
        if ($this->folder !== null) {
            $localName = lcfirst('folder');
            $localValue = is_bool($this->folder) ? ($this->folder ? 'true' : 'false') : $this->folder;
            if (strpos($resourcePath, '{' . $localName . '}') !== false) {
                $resourcePath = str_replace('{' . $localName . '}', ObjectSerializer::toPathValue($localValue), $resourcePath);
            } else {
                $queryParams[$localName] = ObjectSerializer::toQueryValue($localValue);
            }
        }
        // query params
        if ($this->storage !== null) {
            $localName = lcfirst('storage');
            $localValue = is_bool($this->storage) ? ($this->storage ? 'true' : 'false') : $this->storage;
            if (strpos($resourcePath, '{' . $localName . '}') !== false) {
                $resourcePath = str_replace('{' . $localName . '}', ObjectSerializer::toPathValue($localValue), $resourcePath);
            } else {
                $queryParams[$localName] = ObjectSerializer::toQueryValue($localValue);
            }
        }
    
    
        $resourcePath = $this->parseURL($resourcePath, $queryParams, $config);

        // body params
        $httpBody = null;

        if ($multipart) {
            $headers= $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }
        
        list($httpInfo) = [$resourcePath, $formParams, $queryParams, $headerParams, $httpBody, $multipart];
        return $httpInfo;        
    }
}

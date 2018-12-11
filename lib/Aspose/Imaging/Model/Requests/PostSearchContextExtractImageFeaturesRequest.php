<?php
/**
 * --------------------------------------------------------------------------------------------------------------------
 * <copyright company="Aspose" file="PostSearchContextExtractImageFeaturesRequest.php">
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
 * Request model for postSearchContextExtractImageFeatures operation.
 */
class PostSearchContextExtractImageFeaturesRequest extends ImagingRequest
{
    /*
     * The search context identifier.
     */
    public $search_context_id;
	
    /*
     * Input image
     */
    public $image_data;
	
    /*
     * The image identifier.
     */
    public $image_id;
	
    /*
     * Images folder.
     */
    public $images_folder;
	
    /*
     * The folder.
     */
    public $folder;
	
    /*
     * The storage.
     */
    public $storage;
    
    /*
     * Initializes a new instance of the PostSearchContextExtractImageFeaturesRequest class.
     *  
     * @param string $search_context_id The search context identifier.
     * @param \SplFileObject $image_data Input image
     * @param string $image_id The image identifier.
     * @param string $images_folder Images folder.
     * @param string $folder The folder.
     * @param string $storage The storage.
     */
    public function __construct($search_context_id, $image_data = null, $image_id = null, $images_folder = null, $folder = null, $storage = null)             
    {
        parent::__construct();
        $this->search_context_id = $search_context_id;
        $this->image_data = $image_data;
        $this->image_id = $image_id;
        $this->images_folder = $images_folder;
        $this->folder = $folder;
        $this->storage = $storage;
    }

    /*
     * The search context identifier.
     */
    public function get_search_context_id()
    {
        return $this->search_context_id;
    }

    /*
     * The search context identifier.
     */
    public function set_search_context_id($value)
    {
        $this->search_context_id = $value;
        return $this;
    }
	
    /*
     * Input image
     */
    public function get_image_data()
    {
        return $this->image_data;
    }

    /*
     * Input image
     */
    public function set_image_data($value)
    {
        $this->image_data = $value;
        return $this;
    }
	
    /*
     * The image identifier.
     */
    public function get_image_id()
    {
        return $this->image_id;
    }

    /*
     * The image identifier.
     */
    public function set_image_id($value)
    {
        $this->image_id = $value;
        return $this;
    }
	
    /*
     * Images folder.
     */
    public function get_images_folder()
    {
        return $this->images_folder;
    }

    /*
     * Images folder.
     */
    public function set_images_folder($value)
    {
        $this->images_folder = $value;
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
        // verify the required parameter 'search_context_id' is set
        if ($this->search_context_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $search_context_id when calling postSearchContextExtractImageFeatures');
        }

        $resourcePath = '/imaging/ai/imageSearch/{searchContextId}/features';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $multipart = false;
    
        // path params
        if ($this->search_context_id !== null) {
            $localName = lcfirst('searchContextId');
            $resourcePath = str_replace('{' . $localName . '}', ObjectSerializer::toPathValue($this->search_context_id), $resourcePath);
        }

        // query params
        if ($this->image_id !== null) {
            $localName = lcfirst('imageId');
            $localValue = is_bool($this->image_id) ? ($this->image_id ? 'true' : 'false') : $this->image_id;
            if (strpos($resourcePath, '{' . $localName . '}') !== false) {
                $resourcePath = str_replace('{' . $localName . '}', ObjectSerializer::toPathValue($localValue), $resourcePath);
            } else {
                $queryParams[$localName] = ObjectSerializer::toQueryValue($localValue);
            }
        }
        // query params
        if ($this->images_folder !== null) {
            $localName = lcfirst('imagesFolder');
            $localValue = is_bool($this->images_folder) ? ($this->images_folder ? 'true' : 'false') : $this->images_folder;
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

        // form params
        if ($this->image_data !== null) {
            $multipart = true;
            $filename = ObjectSerializer::toFormValue($this->image_data);
            $handle = fopen($filename, "rb");
            $fsize = filesize($filename);
            $contents = fread($handle, $fsize);
            $formParams['image_data'] = $contents;
        }
        // body params
        $httpBody = null;

        if ($multipart) {
            $headers= $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['multipart/form-data']
            );
        }
        
        list($httpInfo) = [$resourcePath, $formParams, $queryParams, $headerParams, $httpBody, $multipart];
        return $httpInfo;        
    }
}

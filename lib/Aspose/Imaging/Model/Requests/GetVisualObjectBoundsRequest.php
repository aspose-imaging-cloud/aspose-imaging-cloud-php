<?php
/**
 * --------------------------------------------------------------------------------------------------------------------
 * <copyright company="Aspose" file="GetVisualObjectBoundsRequest.php">
 *   Copyright (c) 2018-2020 Aspose Pty Ltd. All rights reserved.
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
use \Aspose\Imaging\Configuration;
use \Aspose\Imaging\ObjectSerializer;
use \Aspose\Imaging\Model\Requests\ImagingRequest;

/**
 * Request model for getVisualObjectBounds operation.
 */
class GetVisualObjectBoundsRequest extends ImagingRequest
{
    /**
     * The image features detector.
     *
     * @var string
     */
    public $name;
    
    /**
     * Object detection method
     *
     * @var string
     */
    public $method;
    
    /**
     * Object detection probability threshold in percents
     *
     * @var int
     */
    public $threshold;
    
    /**
     * Draw detected objects labels
     *
     * @var bool
     */
    public $include_label;
    
    /**
     * Draw detected objects scores
     *
     * @var bool
     */
    public $include_score;
    
    /**
     * Comma-separated list of allowed labels
     *
     * @var string
     */
    public $allowed_labels;
    
    /**
     * Comma-separated list of blocked labels
     *
     * @var string
     */
    public $blocked_labels;
    
    /**
     * Bounds, labels, and scores text color
     *
     * @var string
     */
    public $color;
    
    /**
     * The folder.
     *
     * @var string
     */
    public $folder;
    
    /**
     * The storage.
     *
     * @var string
     */
    public $storage;
    
    /**
     * Initializes a new instance of the GetVisualObjectBoundsRequest class.
     *  
     * @param string $name The image features detector.
     * @param string $method Object detection method
     * @param int $threshold Object detection probability threshold in percents
     * @param bool $include_label Draw detected objects labels
     * @param bool $include_score Draw detected objects scores
     * @param string $allowed_labels Comma-separated list of allowed labels
     * @param string $blocked_labels Comma-separated list of blocked labels
     * @param string $color Bounds, labels, and scores text color
     * @param string $folder The folder.
     * @param string $storage The storage.
     */
    public function __construct($name, $method = null, $threshold = null, $include_label = null, $include_score = null, $allowed_labels = null, $blocked_labels = null, $color = null, $folder = null, $storage = null)             
    {
        $this->name = $name;
        $this->method = $method;
        $this->threshold = $threshold;
        $this->include_label = $include_label;
        $this->include_score = $include_score;
        $this->allowed_labels = $allowed_labels;
        $this->blocked_labels = $blocked_labels;
        $this->color = $color;
        $this->folder = $folder;
        $this->storage = $storage;
    }

    /**
     * The image features detector.
     *
     * @return string
     */
    public function get_name()
    {
        return $this->name;
    }

    /**
     * The image features detector.
     *
     * @return \Aspose\Imaging\Model\Requests\Request
     */
    public function set_name($value)
    {
        $this->name = $value;
        return $this;
    }
    
    /**
     * Object detection method
     *
     * @return string
     */
    public function get_method()
    {
        return $this->method;
    }

    /**
     * Object detection method
     *
     * @return \Aspose\Imaging\Model\Requests\Request
     */
    public function set_method($value)
    {
        $this->method = $value;
        return $this;
    }
    
    /**
     * Object detection probability threshold in percents
     *
     * @return int
     */
    public function get_threshold()
    {
        return $this->threshold;
    }

    /**
     * Object detection probability threshold in percents
     *
     * @return \Aspose\Imaging\Model\Requests\Request
     */
    public function set_threshold($value)
    {
        $this->threshold = $value;
        return $this;
    }
    
    /**
     * Draw detected objects labels
     *
     * @return bool
     */
    public function get_include_label()
    {
        return $this->include_label;
    }

    /**
     * Draw detected objects labels
     *
     * @return \Aspose\Imaging\Model\Requests\Request
     */
    public function set_include_label($value)
    {
        $this->include_label = $value;
        return $this;
    }
    
    /**
     * Draw detected objects scores
     *
     * @return bool
     */
    public function get_include_score()
    {
        return $this->include_score;
    }

    /**
     * Draw detected objects scores
     *
     * @return \Aspose\Imaging\Model\Requests\Request
     */
    public function set_include_score($value)
    {
        $this->include_score = $value;
        return $this;
    }
    
    /**
     * Comma-separated list of allowed labels
     *
     * @return string
     */
    public function get_allowed_labels()
    {
        return $this->allowed_labels;
    }

    /**
     * Comma-separated list of allowed labels
     *
     * @return \Aspose\Imaging\Model\Requests\Request
     */
    public function set_allowed_labels($value)
    {
        $this->allowed_labels = $value;
        return $this;
    }
    
    /**
     * Comma-separated list of blocked labels
     *
     * @return string
     */
    public function get_blocked_labels()
    {
        return $this->blocked_labels;
    }

    /**
     * Comma-separated list of blocked labels
     *
     * @return \Aspose\Imaging\Model\Requests\Request
     */
    public function set_blocked_labels($value)
    {
        $this->blocked_labels = $value;
        return $this;
    }
    
    /**
     * Bounds, labels, and scores text color
     *
     * @return string
     */
    public function get_color()
    {
        return $this->color;
    }

    /**
     * Bounds, labels, and scores text color
     *
     * @return \Aspose\Imaging\Model\Requests\Request
     */
    public function set_color($value)
    {
        $this->color = $value;
        return $this;
    }
    
    /**
     * The folder.
     *
     * @return string
     */
    public function get_folder()
    {
        return $this->folder;
    }

    /**
     * The folder.
     *
     * @return \Aspose\Imaging\Model\Requests\Request
     */
    public function set_folder($value)
    {
        $this->folder = $value;
        return $this;
    }
    
    /**
     * The storage.
     *
     * @return string
     */
    public function get_storage()
    {
        return $this->storage;
    }

    /**
     * The storage.
     *
     * @return \Aspose\Imaging\Model\Requests\Request
     */
    public function set_storage($value)
    {
        $this->storage = $value;
        return $this;
    }

    /**
     * Prepares initial info for HTTP request
     *
     * @param \Aspose\Imaging\Configuration $config Imaging API configuration.
     */
    public function getHttpRequestInfo($config)
    {
        // verify the required parameter 'name' is set
        if ($this->name === null) {
            throw new \InvalidArgumentException('Missing the required parameter $name when calling getVisualObjectBounds');
        }

        $resourcePath = '/imaging/ai/objectdetection/{name}/visualbounds';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $headers = [];
    
        // path params
        if ($this->name !== null) {
            $localName = lcfirst('name');
            $resourcePath = str_replace('{' . $localName . '}', ObjectSerializer::toPathValue($this->name), $resourcePath);
        }

        // query params
        if ($this->method !== null) {
            $localName = lcfirst('method');
            $localValue = is_bool($this->method) ? ($this->method ? 'true' : 'false') : $this->method;
            if (strpos($resourcePath, '{' . $localName . '}') !== false) {
                $resourcePath = str_replace('{' . $localName . '}', ObjectSerializer::toPathValue($localValue), $resourcePath);
            } else {
                $queryParams[$localName] = ObjectSerializer::toQueryValue($localValue);
            }
        }
        // query params
        if ($this->threshold !== null) {
            $localName = lcfirst('threshold');
            $localValue = is_bool($this->threshold) ? ($this->threshold ? 'true' : 'false') : $this->threshold;
            if (strpos($resourcePath, '{' . $localName . '}') !== false) {
                $resourcePath = str_replace('{' . $localName . '}', ObjectSerializer::toPathValue($localValue), $resourcePath);
            } else {
                $queryParams[$localName] = ObjectSerializer::toQueryValue($localValue);
            }
        }
        // query params
        if ($this->include_label !== null) {
            $localName = lcfirst('includeLabel');
            $localValue = is_bool($this->include_label) ? ($this->include_label ? 'true' : 'false') : $this->include_label;
            if (strpos($resourcePath, '{' . $localName . '}') !== false) {
                $resourcePath = str_replace('{' . $localName . '}', ObjectSerializer::toPathValue($localValue), $resourcePath);
            } else {
                $queryParams[$localName] = ObjectSerializer::toQueryValue($localValue);
            }
        }
        // query params
        if ($this->include_score !== null) {
            $localName = lcfirst('includeScore');
            $localValue = is_bool($this->include_score) ? ($this->include_score ? 'true' : 'false') : $this->include_score;
            if (strpos($resourcePath, '{' . $localName . '}') !== false) {
                $resourcePath = str_replace('{' . $localName . '}', ObjectSerializer::toPathValue($localValue), $resourcePath);
            } else {
                $queryParams[$localName] = ObjectSerializer::toQueryValue($localValue);
            }
        }
        // query params
        if ($this->allowed_labels !== null) {
            $localName = lcfirst('allowedLabels');
            $localValue = is_bool($this->allowed_labels) ? ($this->allowed_labels ? 'true' : 'false') : $this->allowed_labels;
            if (strpos($resourcePath, '{' . $localName . '}') !== false) {
                $resourcePath = str_replace('{' . $localName . '}', ObjectSerializer::toPathValue($localValue), $resourcePath);
            } else {
                $queryParams[$localName] = ObjectSerializer::toQueryValue($localValue);
            }
        }
        // query params
        if ($this->blocked_labels !== null) {
            $localName = lcfirst('blockedLabels');
            $localValue = is_bool($this->blocked_labels) ? ($this->blocked_labels ? 'true' : 'false') : $this->blocked_labels;
            if (strpos($resourcePath, '{' . $localName . '}') !== false) {
                $resourcePath = str_replace('{' . $localName . '}', ObjectSerializer::toPathValue($localValue), $resourcePath);
            } else {
                $queryParams[$localName] = ObjectSerializer::toQueryValue($localValue);
            }
        }
        // query params
        if ($this->color !== null) {
            $localName = lcfirst('color');
            $localValue = is_bool($this->color) ? ($this->color ? 'true' : 'false') : $this->color;
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
    
    
        $resourcePath = trim($resourcePath, "/") . "?" . http_build_query($queryParams);

        // body params
        $httpBody = null;

        $headers = $this->selectHeaders(
            ['application/json'],
            ['application/json']
        );
        
        $httpInfo = array(
            "resourcePath" => $resourcePath,
            "queryParams" => $queryParams,
            "headerParams" => $headerParams,
            "headers" => $headers,
            "httpBody" => $httpBody,
            "formParams" => $formParams,
        );
        
        return $httpInfo;        
    }
}

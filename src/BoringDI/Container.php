<?php
namespace BoringDI;

class Container
{
    /**
     * @var array
     */
    private $services;

    /**
     * @param string $name
     * @param callable $callback
     */
    public function share($name, callable $callback)
    {
        $this->set('share', $name, $callback);
    }

    /**
     * @param string $name
     * @param callable $callback
     */
    public function factory($name, callable $callback)
    {
        $this->set('factory', $name, $callback);
    }

    /**
     * @param string $type
     * @param string $name
     * @param callable $callback
     */
    private function set($type, $name, callable $callback)
    {
        $this->services[$name] = [
            'callback' => $callback,
            'type' => $type,
        ];
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function get($name)
    {
        if (!isset($this->services[$name])) {
            throw new \InvalidArgumentException('No service detected');
        }

        $service = $this->services[$name];

        if ($service['type'] == 'share') {
            if (isset($service['cache'])) {
                return $service['cache'];
            } else {
                return $this->services[$name]['cache'] = $service['callback']($this);
            }
        } else {
            return $service['callback']($this);
        }
    }
}

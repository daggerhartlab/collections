<?php declare(strict_types=1);

namespace DaggerhartLab\Collections\Map;

use ReflectionClass;
use ReflectionException;

/**
 * Class map is a collection of keyed fully qualified class names.
 */
interface ClassMapInterface extends MapInterface {

  /**
   * Get a reflection instance of the class.
   *
   * @param string|int $key
   *   Name of the class in the map.
   *
   * @return ReflectionClass
   *   Reflection of the class.
   *
   * @throws ReflectionException
   */
  public function getReflection($key): ReflectionClass;

  /**
   * Create a new instance of the class.
   *
   * @param string|int $key
   *   Name of the class in the map.
   * @param array $parameters
   *   Constructor parameters for the class.
   *
   * @return object
   *   Instance of the class.
   *
   * @throws ReflectionException
   */
  public function createInstance($key, array $parameters = []);

}

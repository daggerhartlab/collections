<?php declare(strict_types=1);

namespace DaggerhartLab\Collections;

use ReflectionClass;
use ReflectionException;

/**
 * Class registry is a collection of keyed fully qualified class names.
 */
interface ClassRegistryInterface extends RegistryInterface {

  /**
   * Get a reflection instance of the class.
   *
   * @param string|int $key
   *   Name of the class in the registry.
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
   *   Name of the class in the registry.
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

# Collections

Simple set of collection classes.

| Type                  | Description                                                                                                                        |
|-----------------------|------------------------------------------------------------------------------------------------------------------------------------|
| `Collection`          | A collection is one dimensional list of items that is unconcerned about the name of the individual items.                          |
| `TypedCollection`     | A collection that only allows one data type into the list.                                                                         |
| `Registry`            | A registry is a collection of items where each item in the registry has a unique name.                                             |
| `TypedRegistry`       | A registry that only allows one data type into the collection.                                                                     |
| `ClassRegistry`       | A registry that expects the item values to be fully namespaced class names. It can reflect and instantiate the registered classes. |
| `TraversableRegistry` | A multidimensional registry where deeply nested values can be accessed using dot notation.                                         |

## Examples

### Collection

A collection is one dimensional list of items that is unconcerned about the name of the individual items.

```php
<?php

$collection = new \DaggerhartLab\Collections\Collection(['one', 'two', 'three']);
$collection->add('four');

foreach ($collection as $item) {
  echo $item;
}
```

### TypedCollection

A collection that only allows one data type into the list.

```php
<?php

```

### Registry

A registry is a collection of items where each item in the registry has a unique name.

```php
<?php

$registry = new \DaggerhartLab\Collections\Registry([
  'one' => 1,
  'two' => 'buckle my shoe',
  'three' => 3,
]);
$registry->set('four', 'close the door');

echo $registry->get('two');
echo $registry['four'];
```

### TypedRegistry

A registry that only allows one data type into the collection.

```php
<?php

$type = '\\Big\\Long\\Fqn\\ExampleInterface';
$items = [
  'example' => new \Big\Long\Fqn\ExampleModel(),
  'advanced' => new \Big\Long\Fqn\ExampleAdvancedModel(),
  'another' => new DateTime(),
];
$registry = new TypedRegistry($type, $items);

$example = $registry->get('example');
echo $example->getTitle();
```

### ClassRegistry

A registry that expects the item values to be fully namespaced class names. It can reflect and instantiate the registered classes.

```php
<?php

$registry = new ClassRegistry([
  'example' => '\\Big\\Long\\Fqn\\ExampleModel',
  'advanced' => '\\Big\\Long\\Fqn\\ExampleAdvancedModel',
]);

/**
 * @var \Big\Long\Fqn\ExampleModel $example
 * @var \Big\Long\Fqn\ExampleAdvancedModel $advanced
 */
$example = $registry->createInstance('example');
self::assertInstanceOf('\\Big\\Long\\Fqn\\ExampleModel', $example);

$advanced = $registry->createInstance('advanced', ['param1', 'param2', null, 'param3' => ['is_an_array' => true]]);
self::assertInstanceOf('\\Big\\Long\\Fqn\\ExampleAdvancedModel', $advanced);
```

### TraversableRegistry

A multidimensional registry where deeply nested values can be accessed using dot notation.

Get and set values in a multidimensional registry using dot notation.

```php
<?php

// Get values deeply nested.
$registry = new \DaggerhartLab\Collections\Registry([
  'one' => [
    'two' => [
      'three' => 'four',
    ],
  ],
]);
echo $registry->get('one.two.three');

// Set values deeply nested.
$registry = new \DaggerhartLab\Collections\Registry();
$registry->set('one.two.three', 'four');
var_export($registry->all());
```

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

```php
<?php

$collection = new \DaggerhartLab\Collections\Collection(['one', 'two', 'three']);
$collection->add('four');

foreach ($collection as $item) {
  echo $item;
}
```

### Registry

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

### TraversableRegistry

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

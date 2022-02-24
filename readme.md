# Data Mapper

Creating a data mapper to wrap database arrays.

## Creating a Map class

```php
class ReaderMap implements IDataMapper
{
	// name of the domain object
	public function entity(): string
	{
		return Reader::class;
	}

	public function setters(): array
	{
		return [
			// empty values makes the param required on constructor.
			'id'         => '',
			// this calls setName after the instance has been created.
			'name'		 => 'setName',
		];
	}

	public function types(): array
	{
		return [
			// list of attributes with their casts.
			// can be a function / class
			'id'    => [EntityId::class, 'fromString'],
		];
	}

	public function state($reader): array
	{
		// this converts the Domain Model to an array, so it can be easily saved.
		return [
			'id'    => $reader->getId()->toString(),
			'name'  => $reader->getLastName(),
		];
	}
}
```

## Creating a Manager

```php
$manager = Aecodes\Mapper\Manager::for(ReaderMap::class);
```

Behind the scenes it allows the call to:
- `one` method. and it converts a single row.
- `many` method. and it converts a multiple rows.
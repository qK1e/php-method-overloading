# Method overloading in PHP

This is a userspace implementation of method overloading in PHP. 

## How to use

```php
public function overloaded(...$args) { //get passed arguments via variadic parameter, it's important!
	return Call::firstFit([
		$this->candidate1(...),
		$this->candidate2(...),
		$this->candidate3(...),
	], $args, $this);
}
```

> [!WARNING]
> Don't use `func_get_args` to get passed arguments! It will throw away arguments passed by name!

Currently only first fit algorithm is implemented. So for better candidate detection follow these rules:
- Put candidates with most number of parameters first.
- Put candidates with more specific signatures first.

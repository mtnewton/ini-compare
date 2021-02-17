# ini-compare

quick and dirty php file to help compare differences between two ini files.

replace file1.ini and file2.ini contents with the values to compare

currently code does not care what section the key is under, it matches by key name

`php index.php`
  
```
| Key          | file1.ini  | file2.ini  |
|----------------------------------------|
| SomeBool     | false      | true       |
| AnotherValue | 1000       | !!NotSet!! |
| ThirdValue   | !!NotSet!! | 5          | 
```
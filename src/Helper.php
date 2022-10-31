<?php

namespace lerivera\HelperProject;

class Helper
{
  //1- Multiplicar 2 numeros, sin utilizar el operador de multiplicacion.
  public function multiply(int $num_1, int $num_2): int
  {
    if ($num_1 === 0 || $num_2 === 0) return 0;

    $sum = 0;
    if ($num_1 < 0) {
      for ($i = $num_1; $i < 0; $i++) $sum += $num_2;
      $sum = -$sum;
    } elseif ($num_1 > 0) {
      for ($i = 1; $i <= $num_1; $i++) $sum += $num_2;
    }

    return $sum;
  }

  //2- Obtener el numero mayor dentro de un arreglo. Solo iterar 1 vez.
  public function array_max(array $arr): int | null
  {
    return array_reduce($arr, fn ($max, $actual) => is_int($actual) && ($max === null || $actual > $max) ? $actual : $max, null);
  }

  //3- Dado un arreglo, eliminar todos los "undefined", "null", "false" y 0 (no sus valores en string). Iterar solo 1 vez.
  public function remove_falsy(array $arr): array
  {
    return array_filter($arr, fn ($value): bool => isset($value) && $value !== false && $value !== null && $value !== 0);
  }

  //4- Dado un arreglo multidimensional, obtener todos los valores en un nuevo arreglo de una sola dimension. Usar recursividad
  //Ejemplo: [1, [2, [3, 4]], 'hola', [1, 'buenos dias']] => [1, 2, 3, 4, 'hola', 1, 'buenos dias']
  public function flatten_recursively(array $arr): array
  {
    return array_reduce($arr, fn ($flat, $val) => is_array($val) ? array_merge($flat, $this->flatten_recursively($val)) : array_merge($flat, [$val]), []);
  }

  //5- Dado un string, devolver un objeto/array que indique la palabra que mas veces se repite, y su cantidad.
  //Ejemplo: "Este es un string, el cual es un string donde se repite muchas veces la palabra es" => {es: 3} / ['es' => 3]
  public function repeated_word(string $str): array
  {
    $words = explode(" ", preg_replace('/[^\w\s]/', '', strtolower($str)));
    $count = array_reduce($words, fn ($carry, $word) => [...$carry, $word => isset($carry[$word]) ? $carry[$word] + 1 : 1], []);
    arsort($count, SORT_NUMERIC);

    $firstWord = array_key_first($count);
    return array($firstWord => $count[$firstWord]);
  }

  //6- Verificar si un string es un palíndromo.
  public function is_palindrome(string $str): bool
  {
    if (strlen($str) === 1 || strlen($str) === 0) return true;
    $str = strtolower($str);
    return substr($str, 0, 1) === substr($str, strlen($str) -1, 1) ? $this->is_palindrome(substr($str, 1, strlen($str) -2)) : false;
  }

  //7- Dado 3 numeros, devolver el mayor. Adaptar esto para que funcione con cualquier cantidad de numeros.
  public function get_max_number(...$numbers): int | null
  {
    return $this->array_max($numbers);
  }
}

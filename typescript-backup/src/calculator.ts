interface CalculationResult {
  operation: string;
  a: number;
  b: number;
  result: number;
}

export class Calculator {
  add(a: number, b: number): CalculationResult {
    return {operation: 'penjumlahan', a, b, result: a + b};
  }
  substract(a: number, b: number): CalculationResult {
    return {operation: 'pengurangan', a, b, result: a - b};
  }
  multiply(a: number, b: number): CalculationResult {
    return {operation: 'perkalian', a, b, result: a * b};
  }
  devide(a: number, b: number): CalculationResult {
    if(b === 0) {
      throw new Error("tidak bisa dibagi 0")
    }
    return {operation: 'pembagian', a, b, result: a / b};
  }
  power(a: number, b: number): CalculationResult {
    return {operation: 'pangkat', a, b, result: Math.pow(a, b)};
  }
  sqrt(a: number): CalculationResult {
    if (a < 0) {
      throw new Error("tidak bisa mengakarkuadratkan bilangan negatif");
    }
    return {operation: 'akar kuadrat', a, b: 2, result: Math.sqrt(a)};
  }
}

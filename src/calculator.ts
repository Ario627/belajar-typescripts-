interface CalculationResult {
  operation: string;
  a: number;
  b: number;
  result: number;
}

class Calculator {
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
}
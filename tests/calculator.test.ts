import { Calculator } from '../src/calculator';

describe('Calculator', () => {
  const calc = new Calculator();

  test('add should return correct result', () => {
    expect(calc.add(2, 3)).toEqual({
      operation: 'penjumlahan',
      a: 2,
      b: 3,
      result: 5
    });
  });

  test('substract should return correct result', () => {
    expect(calc.substract(5, 2)).toEqual({
      operation: 'pengurangan',
      a: 5,
      b: 2,
      result: 3
    });
  });

  test('multiply should return correct result', () => {
    expect(calc.multiply(4, 3)).toEqual({
      operation: 'perkalian',
      a: 4,
      b: 3,
      result: 12
    });
  });

  test('devide should return correct result', () => {
    expect(calc.devide(10, 2)).toEqual({
      operation: 'pembagian',
      a: 10,
      b: 2,
      result: 5
    });
  });

  test('devide should throw error when dividing by zero', () => {
    expect(() => calc.devide(10, 0)).toThrow("tidak bisa dibagi 0");
  });
});
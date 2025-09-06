import { Calculator } from "../src/calculator";

describe('Calculator', () => {
  const calc = new Calculator();
  
  test("jumlahkan hingga benar", () => {
    const result = calc.add(2, 5);
    console.log(result)
    expect(result).toEqual({
      operation: "penjumlahan",
      a: 2,
      b: 5,
      result: 7
    });
  });
  
  test("kurangi hingga benar", () => {
    const result = calc.substract(8, 5);
    console.log(result);
    expect(result).toEqual({
      operation: 'pengurangan',
      a: 8,
      b: 5,
      result: 3
    });
  });

  test("pangkat hingga benar", () => {
    const result = calc.power(2, 3);
    console.log(result);
    expect(result).toEqual({
      operation: 'pangkat',
      a: 2,
      b: 3,
      result: 8
    });
  });

  test("akar kuadrat hingga benar", () => {
    const result = calc.sqrt(9);
    console.log(result);
    expect(result).toEqual({
      operation: 'akar kuadrat',
      a: 9,
      b: 2,
      result: 3
    });
  });

  test("akar kuadrat bilangan negatif hingga error", () => {
    expect(() => calc.sqrt(-9)).toThrow("tidak bisa mengakarkuadratkan bilangan negatif");
  });
});
import { Calculator } from "../src/calculator";
describe('Calculator', () => {
    const calc = new Calculator();
    test("jumlahkan hingga benar", () => {
        const result = calc.add(2, 5);
        console.log(result);
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
});
//# sourceMappingURL=calculator.test.js.map
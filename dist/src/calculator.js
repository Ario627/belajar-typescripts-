export class Calculator {
    add(a, b) {
        return { operation: 'penjumlahan', a, b, result: a + b };
    }
    substract(a, b) {
        return { operation: 'pengurangan', a, b, result: a - b };
    }
    multiply(a, b) {
        return { operation: 'perkalian', a, b, result: a * b };
    }
    devide(a, b) {
        if (b === 0) {
            throw new Error("tidak bisa dibagi 0");
        }
        return { operation: 'pembagian', a, b, result: a / b };
    }
}
//# sourceMappingURL=calculator.js.map
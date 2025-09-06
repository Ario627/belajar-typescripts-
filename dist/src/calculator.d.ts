interface CalculationResult {
    operation: string;
    a: number;
    b: number;
    result: number;
}
export declare class Calculator {
    add(a: number, b: number): CalculationResult;
    substract(a: number, b: number): CalculationResult;
    multiply(a: number, b: number): CalculationResult;
    devide(a: number, b: number): CalculationResult;
}
export {};
//# sourceMappingURL=calculator.d.ts.map
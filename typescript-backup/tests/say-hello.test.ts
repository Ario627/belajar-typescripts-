import {sayHello} from "../src/say-hello";

describe('sayHello', function(): void {
  it("should return Hello Ario", function(): void {
    expect(sayHello('Ario')).toBe('Hello Ario');
  });
});
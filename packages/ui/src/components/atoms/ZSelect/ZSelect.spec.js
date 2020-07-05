import { shallowMount } from "@vue/test-utils";
import ZSelect from "./ZSelect.vue";
describe("ZSelect.vue", () => {
  it("renders a component", () => {
    const component = shallowMount(ZSelect);
    expect(component.contains(".z-select")).toBe(true);
  });
});

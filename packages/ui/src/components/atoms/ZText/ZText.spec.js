import { shallowMount } from "@vue/test-utils";
import ZText from "./ZText.vue";
describe("ZText.vue", () => {
  it("renders a component", () => {
    const component = shallowMount(ZText);
    expect(component.contains(".z-text")).toBe(true);
  });
});

import { shallowMount } from "@vue/test-utils";
import ZSection from "./ZSection.vue";
describe("ZSection.vue", () => {
  it("renders a component", () => {
    const component = shallowMount(ZSection);
    expect(component.contains(".z-section")).toBe(true);
  });
});

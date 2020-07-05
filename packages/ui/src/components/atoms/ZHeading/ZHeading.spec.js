import { shallowMount } from "@vue/test-utils";
import ZHeading from "./ZHeading.vue";
describe("ZHeading.vue", () => {
  it("renders a component", () => {
    const component = shallowMount(ZHeading);
    expect(component.contains(".z-heading")).toBe(true);
  });
});

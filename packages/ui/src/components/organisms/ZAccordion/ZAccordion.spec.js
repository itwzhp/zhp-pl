import { shallowMount } from "@vue/test-utils";
import ZAccordion from "./ZAccordion.vue";
describe("ZAccordion.vue", () => {
  it("renders a component", () => {
    const component = shallowMount(ZAccordion);
    expect(component.get(".z-accordion"));
  });
});

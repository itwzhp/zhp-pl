import { shallowMount } from "@vue/test-utils";
import ZAuthor from "./ZAuthor.vue";
describe("ZAuthor.vue", () => {
  it("renders a component", () => {
    const component = shallowMount(ZAuthor);
    expect(component.get(".z-author"));
  });
});

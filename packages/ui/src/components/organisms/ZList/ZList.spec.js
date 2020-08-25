import { shallowMount } from '@vue/test-utils';
import ZList from './ZList.vue';

describe('ZList.vue', () => {
  it('renders a component', () => {
    const component = shallowMount(ZList);
    expect(component.contains('.z-list')).toBe(true);
  });
});

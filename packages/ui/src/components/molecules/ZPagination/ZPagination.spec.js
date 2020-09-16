import { shallowMount } from '@vue/test-utils';
import ZPagination from './ZPagination.vue';

describe('ZPagination.vue', () => {
  it('renders a component', () => {
    const component = shallowMount(ZPagination);
    expect(component.get('.z-pagination'));
  });
});
